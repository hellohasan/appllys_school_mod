<?php

namespace App\Http\Controllers\API\Academic;

use Carbon\Carbon;
use App\Models\AcademicData;
use App\Models\AcademicExam;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\AcademicGroup;
use App\Models\AcademicExamLog;
use App\Models\AcademicSession;
use App\Models\AcademicSubject;
use App\Models\AcademicExamClass;
use App\Models\AcademicDepartment;
use App\Models\AcademicDataSubject;
use App\Models\AcademicExamRoutine;
use App\Http\Controllers\Controller;

class AcademicExamController extends Controller {
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
            if ($list['type'] == 1) {
                $ll['academic_group_id'] = $list['group_id'];
                foreach ($list['group_section_ids'] as $sId) {
                    $ll['group_section_id'] = $sId;
                    AcademicExamClass::create($ll);
                }
            } elseif ($list['type'] == 2) {
                $ll['academic_department_id'] = $list['department_id'];
                foreach ($list['department_year_ids'] as $sId) {
                    $ll['department_year_id'] = $sId;
                    AcademicExamClass::create($ll);
                }
            } else {
                foreach ($list['section_ids'] as $sId) {
                    $ll['academic_section_id'] = $sId;
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
            'classes.academicClass:id,name',
            'classes.academicGroup:id,name',
            'classes.academicDepartment:id,name',
            'classes.section:id,name',
            'classes.groupSection:id,name',
            'classes.year:id,name',
            'classes.logs',
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
        $class = AcademicExamClass::find($request->input("id"));

        $data = AcademicData::query();
        $data = $data->where('academic_session_id', $exam->academic_session_id)->whereAcademicClassId($class->academic_class_id);

        if ($class->type == 1) {
            $data = $data->whereAcademicGroupId($class->academic_group_id)->whereAcademicSectionId($class->group_section_id);
        } elseif ($class->type == 2) {
            $data = $data->whereAcademicDepartmentId($class->academic_department_id)->whereAcademicYearId($class->department_year_id);
        } else {
            $data = $data->whereAcademicSectionId($class->academic_section_id);
        }

        $studentData = $data->pluck('id')->toArray();
        $subjects = AcademicDataSubject::whereIn('academic_data_id', $studentData)->get();

        $class->logs()->delete();

        foreach ($subjects as $subject) {
            $tr['academic_exam_id'] = $exam->id;
            $tr['academic_exam_class_id'] = $class->id;
            $tr['user_id'] = $subject->user_id;
            $tr['academic_subject_id'] = $subject->academic_subject_id;
            $tr['academic_data_subject_id'] = $subject->id;
            $tr['is_optional'] = $subject->isOptional;
            $tr['updated_by'] = auth()->id();
            AcademicExamLog::create($tr);
        }

        $class->is_assigned = true;
        $class->save();

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

        $classes = AcademicExamClass::whereAcademicExamId($exam->id)->get();
        $subjects = [];
        foreach ($classes->groupBy('academic_class_id') as $class) {
            $forClass = $class->first();
            if ($forClass->type == 0) {
                $subjects[] = AcademicSubject::with(['academic_class:id,name'])
                    ->whereAcademicClassId($forClass->academic_class_id)
                    ->select('id', 'name', 'code', 'academic_class_id', 'academic_class_type', 'academic_group_id', 'academic_section_id', 'academic_department_id', 'academic_year_id')->get();
            } elseif ($forClass->type == 1) {
                $forGroup = $class->groupBy(['academic_group_id']);
                $subjects[] = AcademicSubject::with(['academic_class:id,name'])
                    ->whereAcademicClassId($forClass->academic_class_id)
                    ->whereIn('academic_group_id', $forGroup->keys()->toArray())
                    ->select('id', 'name', 'code', 'academic_class_id', 'academic_class_type', 'academic_group_id', 'academic_section_id', 'academic_department_id', 'academic_year_id')->get();
            } else {
                $forDepartment = $class->groupBy(['academic_department_id', 'department_year_id']);
                foreach ($forDepartment as $m => $d) {
                    $subjects[] = AcademicSubject::with(['academic_class:id,name'])
                        ->whereAcademicClassId($forClass->academic_class_id)
                        ->where('academic_department_id', $m)
                        ->whereIn('academic_year_id', $d->keys())
                        ->select('id', 'name', 'code', 'academic_class_id', 'academic_class_type', 'academic_group_id', 'academic_section_id', 'academic_department_id', 'academic_year_id')->get();
                }
            }
        }
        $index = 0;
        $sub = [];
        foreach ($subjects as $subject) {
            foreach ($subject as $s) {
                $sub[$index]['id'] = $s->id;
                $sub[$index]['text'] = $this->findSubjectName($s);
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
            $rr['date'] = '';
            $rr['subject_ids'] = [];
            $rr['start_time'] = '';
            $rr['end_time'] = '';
        }
        $data['routines'] = $rr;

        return response()->json($data, 200);

    }

    /**
     * @param $id
     */
    public function findSubjectName($s) {
        if ($s->academic_class_type == 2) {
            $department = AcademicDepartment::find($s->academic_department_id)->name;
            $year = AcademicYear::find($s->academic_year_id)->name;
            $su = $s->academic_class->name . ' - (' . $department . ') - (' . $year . ') - ' . $s->name . ' - (' . $s->code . ')';
        } elseif ($s->academic_class_type == 1) {
            $group = AcademicGroup::find($s->academic_group_id)->name;
            $su = $s->academic_class->name . ' - (' . $group . ') - ' . $s->name . ' - (' . $s->code . ')';
        } else {
            $su = $s->academic_class->name . ' - ' . $s->name . ' - (' . $s->code . ')';
        }

        return $su;
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
                $in['academic_subject_id'] = $subject;
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
            'routines.academic_subject',
            'routines.academic_subject.academic_class:id,name',
            'routines.academic_subject.academic_group:id,name',
            'routines.academic_subject.academic_department:id,name',
            'routines.academic_subject.department_year:id,name',
        ])->whereCustom($custom)->firstOrFail();
        $data['exam'] = $exam;

        $data['routines'] = $exam->routines->groupBy('date')->toArray();

        return response()->json($data, 200);
    }
}
