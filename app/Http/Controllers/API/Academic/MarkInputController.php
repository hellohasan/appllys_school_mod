<?php

namespace App\Http\Controllers\API\Academic;

use App\User;
use Carbon\Carbon;
use App\Models\AcademicExam;
use Illuminate\Http\Request;
use App\Models\TeacherSubject;
use App\Models\AcademicExamLog;
use App\Models\AcademicSession;
use App\Models\AcademicSubject;
use App\Models\AcademicExamClass;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AcademicSubjectLevel;

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
            'level',
        ])->orderBy('academic_class_id', 'asc')->whereAcademicExamId($examID)->get();

        $lists = [];
        $i = 0;
        foreach ($classes as $class) {
            $lists[$i]['id'] = $class->id;
            $lists[$i]['text'] = $class->level->details['details'];
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

        $examClass = AcademicExamClass::findOrFail($examClassId);

        $subjects = AcademicSubjectLevel::with('subject')
            ->whereAcademicLevelId($examClass->academic_level_id)
            ->pluck('academic_subject_id')
            ->toArray();

        $user = User::find(auth()->id());
        if ($user->hasAnyRole(['Super Admin', 'Admin'])) {
            $lists = AcademicSubject::whereIn('id', $subjects)
                ->select(['id', DB::raw('CONCAT("(",code,") - ",name) AS text')])->get();

        } elseif ($user->hasRole('Teacher')) {
            $teacherSubjects = TeacherSubject::whereAcademicLevelId($examClass->academic_level_id)
                ->whereIn('academic_subject_id', $subjects)
                ->whereAcademicSessionId(request('session_id'))
                ->whereTeacherId(auth()->id())
                ->pluck('academic_subject_id')
                ->toArray();

            $lists = AcademicSubject::whereIn('id', $teacherSubjects)
                ->select(['id', DB::raw('CONCAT("(",code,") - ",name) AS text')])->get();
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
            'level',
        ])->find($request->input("academic_exam_class_id"));

        $data['session'] = $session->duration;
        $data['exam'] = $exam->custom . ' - ' . $exam->title;
        $data['subject'] = $subject;

        /* find subject teacher */
        $teacher = TeacherSubject::whereAcademicSessionId($session->id)
            ->whereAcademicLevelId($examClass->academic_level_id)
            ->whereAcademicSubjectId($subject->id)
            ->first();
        if ($teacher) {
            $data['teacher'] = $teacher->teacher->custom . ' - ' . $teacher->teacher->name;
        } else {
            $data['teacher'] = 'Not Assign';
        }

        $data['academicDetails'] = $examClass->level->details['details'];

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
