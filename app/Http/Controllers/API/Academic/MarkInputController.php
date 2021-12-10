<?php

namespace App\Http\Controllers\API\Academic;

use App\User;
use Carbon\Carbon;
use App\Models\AcademicExam;
use Illuminate\Http\Request;
use App\Models\SubjectAssign;
use App\Models\TeacherSubject;
use App\Models\AcademicExamLog;
use App\Models\AcademicSession;
use App\Models\AcademicSubject;
use App\Models\AcademicExamClass;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MarkInputController extends Controller {
    /**
     * @param Request $request
     */
    public function loadSessionExam(Request $request) {
        $session = $request->input("id");
        return AcademicExam::whereAcademicSessionId($session)->select(['id', DB::raw('CONCAT(custom," - ",title) AS text')])->orderByDesc('id')->get();
    }

    /**
     * @param Request $request
     */
    public function loadExamClass(Request $request) {
        $examID = $request->input("id");
        $classes = AcademicExamClass::with([
            'academicClass:id,name',
            'academicGroup:id,name',
            'academicDepartment:id,name',
            'section:id,name',
            'groupSection:id,name',
            'year:id,name',
        ])->orderBy('academic_class_id', 'asc')->whereAcademicExamId($examID)->get();
        $lists = [];
        $i = 0;
        foreach ($classes as $class) {

            $lists[$i]['id'] = $class->id;
            if ($class->type == 0) {
                $lists[$i]['text'] = $class->academicClass->name . ' - ' . $class->section->name;
            } elseif ($class->type == 1) {
                $lists[$i]['text'] = $class->academicClass->name . ' - ' . $class->academicGroup->name . ' - ' . $class->groupSection->name;
            } else {
                $lists[$i]['text'] = $class->academicClass->name . ' - ' . $class->academicDepartment->name . ' - ' . $class->year->name;
            }
            $i++;
        }
        return $lists;
    }

    /**
     * @param Request $request
     */
    public function loadExamClassSubject(Request $request) {
        $examClassId = $request->input("id");
        $sessionId = $request->input("session_id");

        $subject = AcademicExamClass::findOrFail($examClassId);
        $lists = AcademicSubject::query();
        $lists = $lists->whereAcademicClassId($subject->academic_class_id);
        if ($subject->type == 1) {
            $lists = $lists->whereAcademicGroupId($subject->academic_group_id);
        } elseif ($subject->type == 2) {
            $lists = $lists->whereAcademicDepartmentId($subject->academic_department_id)
                ->whereAcademicYearId($subject->department_year_id);
        }

        $user = User::find(auth()->id());
        if ($user->hasAnyRole(['Super Admin', 'Admin'])) {
            $lists = $lists->select(['id', DB::raw('CONCAT("(",code,") - ",name) AS text')])->get();
        } elseif ($user->hasRole('Teacher')) {
            $assign = SubjectAssign::query();
            $assign = $assign->whereSessionId($sessionId)->whereAcademicClassId($subject->academic_class_id);
            if ($subject->type == 2) {
                $assign = $assign->whereAcademicDepartmentId($subject->academic_department_id)->whereAcademicYearId($subject->department_year_id);
            } elseif ($subject->type == 1) {
                $assign = $assign->whereAcademicGroupId($subject->academic_group_id)->whereAcademicGroupSectionId($subject->group_section_id);
            } else {
                $assign = $assign->whereAcademicSectionId($subject->academic_section_id);
            }

            $assign = $assign->first();
            if ($assign) {
                $subs = TeacherSubject::whereSubjectAssignId($assign->id)->whereTeacherId($user->id)->pluck('academic_subject_id')->toArray();
                $lists = $lists->whereIn('id', $subs)->select(['id', DB::raw('CONCAT("(",code,") - ",name) AS text')])->get();
            } else {
                $lists = [];
            }
        } else {
            $lists = [];
        }

        return $lists;
    }

    /**
     * @param Request $request
     */
    public function loadMarkInputStudents(Request $request) {
        $request->validate([
            'academic_session_id'    => ['required'],
            'academic_exam_id'       => ['required'],
            'academic_exam_class_id' => ['required'],
            'academic_subject_id'    => ['required'],
        ]);

        $students = AcademicExamLog::with([
            'user:id,name,custom,photo,phone',
            'subject',
        ])->whereAcademicExamId($request->input("academic_exam_id"))
            ->whereAcademicExamClassId($request->input("academic_exam_class_id"))
            ->whereAcademicSubjectId($request->input("academic_subject_id"))->get();

        return $students;

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function submitInputtedMark(Request $request) {
        $marks = $request->input('marks');
        $form = $request->input("form");
        $examClass = AcademicExamClass::find($form["academic_exam_class_id"]);
        $grades = $examClass->academicClass->grading->percentages;
        $subjectFullMark = AcademicSubject::find($form["academic_subject_id"])->full_mark;

        foreach ($marks as $mark) {
            $log = AcademicExamLog::find($mark['log_id']);
            $log->status = $mark['status'];
            $log->theory = $mark['theory'];
            $log->practical = $mark['practical'];
            $log->total_gain = customRound($mark['theory'] + $mark['practical']);
            $log->grade_percentage_id = $this->findGrade($subjectFullMark, $log->total_gain, $grades);
            $log->save();
        }
    }

    /**
     * @param $total
     * @param $grades
     */
    public function findGrade($fullMark, $gain, $grades) {
        foreach ($grades as $grade) {
            if ($gain >= customPercentage($fullMark, $grade['min_percentage']) && $gain <= customPercentage($fullMark, $grade['max_percentage'])) {
                return $grade['id'];
            }
        }
    }

    /**
     * @param Request $request
     */
    public function markInputPrint(Request $request) {

        $request->validate([
            'academic_session_id'    => ['required'],
            'academic_exam_id'       => ['required'],
            'academic_exam_class_id' => ['required'],
            'academic_subject_id'    => ['required'],
        ]);

        $exam = AcademicExam::find($request->input("academic_exam_id"));
        $session = AcademicSession::find($request->input("academic_session_id"));
        $subject = AcademicSubject::find($request->input("academic_subject_id"));
        $examClass = AcademicExamClass::with([
            'academicClass:id,name',
            'academicGroup:id,name',
            'academicDepartment:id,name',
            'section:id,name',
            'groupSection:id,name',
            'year:id,name',
        ])->find($request->input("academic_exam_class_id"));

        $data['session'] = $session->duration;
        $data['exam'] = $exam->custom . ' - ' . $exam->title;
        $data['subject'] = $subject;

        $assign = SubjectAssign::query();
        $assign = $assign->whereSessionId($request->input("academic_session_id"))
            ->whereAcademicClassId($examClass->academic_class_id)
            ->whereType($examClass->type);

        if ($examClass->type == 2) {
            $assign = $assign->where('academic_department_id', $examClass->academic_department_id)
                ->where('academic_year_id', $examClass->department_year_id);
        } elseif ($examClass->type == 1) {
            $assign = $assign->where('academic_group_id', $examClass->academic_group_id)
                ->where('academic_group_section_id', $examClass->group_section_id);
        } else {
            $assign = $assign->where('academic_section_id', $examClass->academic_section_id);
        }

        $assign = $assign->first();

        if ($assign) {
            $teacher = TeacherSubject::with('teacher')->whereSubjectAssignId($assign->id)->whereAcademicSubjectId($request->input("academic_subject_id"))->first();
            if ($teacher) {
                $data['teacher'] = $teacher->teacher->custom . ' - ' . $teacher->teacher->name;
            } else {
                $data['teacher'] = 'N/A';
            }
        } else {
            $data['teacher'] = 'N/A';
        }

        if ($examClass->type == 1) {
            $data['academicDetails'] = $examClass->academicClass->name . ' - ' . $examClass->academicGroup->name . ' - ' . $examClass->groupSection->name;
        } elseif ($examClass->type == 2) {
            $data['academicDetails'] = $examClass->academicClass->name . ' - ' . $examClass->academicDepartment->name . ' - ' . $examClass->year->name;
        } else {
            $data['academicDetails'] = $examClass->academicClass->name . ' - ' . $examClass->section->name;
        }

        $students = AcademicExamLog::with([
            'user:id,name,custom,phone',
            'grade:id,name',
        ])->whereAcademicExamId($request->input("academic_exam_id"))
            ->whereAcademicExamClassId($request->input("academic_exam_class_id"))
            ->whereAcademicSubjectId($request->input("academic_subject_id"))->get();

        $data['students'] = $students;
        if ($students->count()) {
            $data['submitted'] = Carbon::parse($students->first()->updated_at)->toDayDateTimeString();
        } else {
            $data['submitted'] = 'N/A';
        }

        return response()->json($data, 200);

    }

}
