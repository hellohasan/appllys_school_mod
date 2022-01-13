<?php

namespace App\Http\Controllers\API\Academic;

use Carbon\Carbon;
use App\Models\AcademicData;
use App\Models\AcademicExam;
use Illuminate\Http\Request;
use App\Models\AcademicLevel;
use App\Models\AcademicExamLog;
use App\Models\AcademicSession;
use App\Http\Traits\HelperTrait;
use App\Models\AcademicExamClass;
use Illuminate\Support\Facades\DB;
use App\Models\AcademicDataSubject;
use App\Models\AcademicExamRoutine;
use App\Http\Controllers\Controller;
use App\Models\AcademicSubjectLevel;

class AcademicExamController extends Controller {
    use HelperTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return AcademicExam::orderBy('custom', 'desc')->withCount('students')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate([
            'title'            => ['required'],
            'daterange'        => ['required'],
            'lists'            => ['required', 'array'],
            'lists.*.class_id' => ['required'],
            'lists.*.type'     => ['required'],
            /* FIXME: take decision for this comment */
            /* 'lists.*.section_ids'         => 'required_if:lists.*.type, 0',
        'lists.*.group_id'            => 'required_if:lists.*.type, 1',
        'lists.*.group_section_ids'   => 'required_if: lists.*.type, 1',
        'lists.*.department_id'       => 'required_if: lists.*.type, 2',
        'lists.*.department_year_ids' => 'required_if: lists.*.type, 2', */
        ]);

        $in['title'] = $request->input("title");
        $in['start_date'] = Carbon::parse($request->input("daterange")[0])->format('Y-m-d');
        $in['end_date'] = Carbon::parse($request->input("daterange")[1])->format('Y-m-d');
        $in['created_by'] = auth()->id();
        $in['academic_session_id'] = AcademicSession::where('isCurrent', true)->first()->id;
        $exam = AcademicExam::create($in);
        $exam->custom = custom($exam->id);
        $exam->save();

        foreach ($request->input("lists") as $list) {
            $ll = [];
            $ll['academic_exam_id'] = $exam->id;
            $ll['academic_class_id'] = $list['class_id'];
            $ll['type'] = $list['type'];
            $levelId = AcademicLevel::query();
            $levelId = $levelId->whereAcademicClassId($list['class_id']);

            if ($list['type'] == 1) {
                foreach ($list['group_section_ids'] as $sId) {
                    $ll['academic_level_id'] = $this->findAcademicLevelID($list['class_id'], $list['type'], $list['group_id'], $sId);
                    AcademicExamClass::create($ll);
                }
            } elseif ($list['type'] == 2) {
                foreach ($list['department_year_ids'] as $sIdd) {
                    $ll['academic_level_id'] = $this->findAcademicLevelID($list['class_id'], $list['type'], $list['department_id'], $sIdd);
                    AcademicExamClass::create($ll);
                }
            } else {
                foreach ($list['section_ids'] as $s) {
                    $ll['academic_level_id'] = $this->findAcademicLevelID($list['class_id'], $list['type'], $s);
                    AcademicExamClass::create($ll);
                }
            }
        }

        return response()->json(['custom' => $exam->custom], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $data = AcademicExam::with([
            'creator:id,name',
            'session:id,duration',
            'classes',
            'classes.level',
        ])->whereCustom($id)->firstOrFail();

        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    /**
     * @param Request $request
     */
    public function assignExam(Request $request) {

        $exam = AcademicExam::whereCustom($request->input("custom"))->first();
        $examClass = AcademicExamClass::find($request->input("id"));

        $studentData = AcademicData::whereAcademicSessionId($exam->academic_session_id)
            ->whereAcademicLevelId($examClass->academic_level_id)->pluck('id')->toArray();

        $subjects = AcademicDataSubject::whereIn('academic_data_id', $studentData)->get();

        $examClass->total_students = count($studentData);
        $examClass->save();
        $examClass->logs()->delete();

        foreach ($subjects as $subject) {
            $tr['academic_exam_id'] = $exam->id;
            $tr['academic_exam_class_id'] = $examClass->id;
            $tr['user_id'] = $subject->user_id;
            $tr['academic_subject_id'] = $subject->academic_subject_id;
            $tr['academic_data_subject_id'] = $subject->id;
            $tr['academic_level_id'] = $examClass->academic_level_id;
            $tr['is_optional'] = $subject->isOptional;
            $tr['updated_by'] = auth()->id();
            AcademicExamLog::create($tr);
        }

        $examClass->is_assigned = true;
        $examClass->save();

        return response()->json(['message' => 'Successfully Submitted'], 200);
    }

    /**
     * @param $custom
     * @param $id
     */
    public function examRoutine($custom) {
        $exam = AcademicExam::with([
            'creator:id,name',
            'session:id,duration',
        ])->whereCustom($custom)->firstOrFail();
        $data['exam'] = $exam;

        $classes = DB::table('academic_exam_classes')->select('academic_class_id', 'academic_level_id')->whereAcademicExamId($exam->id)->get();

        $sub = [];
        $index = 0;
        foreach ($classes as $class) {
            $subjects = AcademicSubjectLevel::with([
                'subject:id,name,code',
                'level',
            ])->whereAcademicClassId($class->academic_class_id)->whereAcademicLevelId($class->academic_level_id)->get();

            foreach ($subjects as $subject) {
                $sub[$index]['id'] = $subject->id;
                $sub[$index]['text'] = $subject->level->details['details'] . ' - (' . $subject->subject->code . ') - ' . $subject->subject->name;
                $index++;
            }
        }

        $data['subjects'] = $sub;

        $routines = $exam->routines->groupBy('date');
        if ($routines->count()) {
            $index = 0;
            foreach ($routines as $key => $routine) {
                $rr[$index]['date'] = $key;
                foreach ($routine->pluck('academic_subject_id')->all() as $key => $sub) {
                    $ss[$key] = (string) $sub;
                }
                $rr[$index]['subject_ids'] = $ss;
                $rr[$index]['start_time'] = $routine->first()->start_time;
                $rr[$index]['end_time'] = $routine->first()->end_time;
                $index++;
            }
        } else {
            $rr[0]['date'] = '';
            $rr[0]['subject_ids'] = [];
            $rr[0]['start_time'] = '';
            $rr[0]['end_time'] = '';
        }
        $data['routines'] = $rr;

        return response()->json($data, 200);

    }

    /**
     * @param $id
     */
    public function findSubjectName($s) {

        /* if ($s->academic_class_type == 2) {
        $department = AcademicDepartment::find($s->academic_department_id)->name;
        $year = AcademicYear::find($s->academic_year_id)->name;
        $su = $s->academic_class->name . ' - (' . $department . ') - (' . $year . ') - ' . $s->name . ' - (' . $s->code . ')';
        } elseif ($s->academic_class_type == 1) {
        $group = AcademicGroup::find($s->academic_group_id)->name;
        $su = $s->academic_class->name . ' - (' . $group . ') - ' . $s->name . ' - (' . $s->code . ')';
        } else {
        $su = $s->academic_class->name . ' - ' . $s->name . ' - (' . $s->code . ')';
        } */

        return 'hasanb';
    }

    /**
     * @param Request $request
     */
    public function examRoutineSubmit(Request $request) {
        $request->validate([
            "exam_id"               => "required",
            'routine'               => 'required|array',
            'routine.*.date'        => 'required|date',
            'routine.*.subject_ids' => 'required|array',
            'routine.*.start_time'  => 'required',
            'routine.*.end_time'    => 'required',
        ]);

        $exam = AcademicExam::find($request->input("exam_id"));

        $exam->routines()->delete();

        $in['academic_exam_id'] = $request->input("exam_id");
        foreach ($request->input("routine") as $routine) {
            $in['date'] = $routine['date'];
            $in['start_time'] = $routine['start_time'];
            $in['end_time'] = $routine['end_time'];
            foreach ($routine['subject_ids'] as $subject) {
                $in['academic_subject_level_id'] = $subject;
                AcademicExamRoutine::create($in);
            }
        }

        $exam->is_routine = true;
        $exam->save();

        return response()->json(['custom' => $exam->custom], 200);
    }

    /**
     * @param $custom
     */
    public function examRoutineShow($custom) {
        $exam = AcademicExam::with([
            'creator:id,name',
            'session:id,duration',
            'routines',
            'routines.academic_subject_level.subject:id,name,code',
            'routines.academic_subject_level.level',
        ])->whereCustom($custom)->firstOrFail();
        $data['exam'] = $exam;

        $data['routines'] = $exam->routines->groupBy('date')->toArray();

        return response()->json($data, 200);
    }
}
