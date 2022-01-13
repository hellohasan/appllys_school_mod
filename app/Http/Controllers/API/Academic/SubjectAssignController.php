<?php

namespace App\Http\Controllers\API\Academic;

use Carbon\Carbon;
use App\Models\Day;
use Illuminate\Http\Request;
use App\Models\SubjectAssign;
use App\Models\TeacherSubject;
use App\Models\AcademicSession;
use App\Models\AcademicSubject;
use App\Http\Traits\HelperTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AcademicSubjectLevel;

class SubjectAssignController extends Controller {

    use HelperTrait;
    public function __construct() {
        // middleware goes here

    }

    /**
     * @param Request $request
     */
    public function getSubjectList(Request $request) {

        $type = $request->input("academic_class_type");
        if ($type == 2) {
            $levelId = $this->findAcademicLevelID(request('academic_class_id'), $type, request('academic_department_id'), request('academic_year_id'));
        } elseif ($type == 1) {
            $levelId = $this->findAcademicLevelID(request('academic_class_id'), $type, request('academic_group_id'), request('academic_group_section_id'));
        } else {
            $levelId = $this->findAcademicLevelID(request('academic_class_id'), $type, request('academic_section_id'));
        }
        $subjectIds = AcademicSubjectLevel::whereAcademicLevelId($levelId)->pluck('academic_subject_id')->toArray();
        $session = AcademicSession::where('isCurrent', 1)->first();
        $days = Day::where('name', '!=', $session->off_day)->get();

        $subjects = AcademicSubject::whereIn('id', $subjectIds)->select([
            'id',
            'name',
            'code',
            'subject_type',
            'point',
        ])->whereStatus(1)->get();

        $previous = SubjectAssign::whereSessionId(request('session_id'))->whereAcademicLevelId($levelId)->first();
        $data['custom'] = $previous ? $previous->custom : '';
        $data['subjects'] = [];
        foreach ($subjects as $key => $subject) {
            if ($previous) {
                $lists = $previous->lists->where('academic_subject_id', $subject->id);
            } else {
                $lists = collect([]);
            }
            $data['subjects'][$key]['subject_id'] = $subject->id;
            $data['subjects'][$key]['subject_name'] = $subject->name;
            $data['subjects'][$key]['subject_code'] = $subject->code;
            $data['subjects'][$key]['subject_type'] = $subject->subject_type;
            $data['subjects'][$key]['subject_point'] = $subject->point;
            foreach ($days as $d => $day) {

                if ($lists) {
                    $single = $lists->where('day_id', $day->id)->first();
                } else {
                    $single = collect();
                }

                $data['subjects'][$key]['days'][$d] = [
                    'day_id'      => $day->id,
                    'day_name'    => $day->name,
                    'day_name_bn' => $day->name_bn,
                    'teacher_id'  => $single ? $single->teacher_id : '',
                    'period_id'   => $single ? $single->period_id : '',
                ];
            }
        }

        return response()->json($data, 200);
    }

    /**
     * @param Request $request
     */
    public function submitAssignList(Request $request) {

        $request->validate([
            "session_id"                   => "required",
            'academic_class_id'            => ['required'],
            'academic_class_type'          => ['required'],
            'academic_section_id'          => 'required_if:academic_class_type,0',
            'academic_group_id'            => 'required_if:academic_class_type,1',
            'academic_group_section_id'    => 'required_if:academic_class_type,1',
            'academic_department_id'       => 'required_if:academic_class_type,2',
            'academic_year_id'             => 'required_if:academic_class_type,2',
            'subjects.*.days'              => ['required', 'array'],
            'subjects.*.days.*.day_id'     => ['required'],
            'subjects.*.days.*.teacher_id' => ['required'],
            'subjects.*.days.*.period_id'  => ['required'],
        ]);

        try {
            DB::beginTransaction();

            $type = $request->input("academic_class_type");

            if ($request->input("custom")) {
                $assign = SubjectAssign::whereCustom($request->input("custom"))->firstOrFail();
            } else {

                if ($type == 2) {
                    $levelId = $this->findAcademicLevelID(request('academic_class_id'), $type, request('academic_department_id'), request('academic_year_id'));
                } elseif ($type == 1) {
                    $levelId = $this->findAcademicLevelID(request('academic_class_id'), $type, request('academic_group_id'), request('academic_group_section_id'));
                } else {
                    $levelId = $this->findAcademicLevelID(request('academic_class_id'), $type, request('academic_section_id'));
                }
                $assign = SubjectAssign::create([
                    "session_id"        => $request->input("session_id"),
                    'academic_class_id' => $request->input("academic_class_id"),
                    'type'              => $type,
                    'academic_level_id' => $levelId,
                ]);

                $assign->custom = custom($assign->id);
                $assign->save();
            }

            $assign->lists()->delete();
            $assign->teachers()->delete();

            foreach ($request->input('subjects') as $subject) {
                $data['academic_subject_id'] = $subject['subject_id'];
                foreach ($subject['days'] as $d => $day) {
                    $data['day_id'] = $day['day_id'];
                    $data['teacher_id'] = $day['teacher_id'];
                    $data['period_id'] = $day['period_id'];
                    $assign->lists()->create($data);

                    $chk = TeacherSubject::whereSubjectAssignId($assign->id)
                        ->whereTeacherId($day['teacher_id'])
                        ->whereAcademicSubjectId($subject['subject_id'])
                        ->exists();

                    if (!$chk) {
                        $assign->teachers()->create([
                            'academic_session_id' => $request->input("session_id"),
                            'teacher_id'          => $day['teacher_id'],
                            'academic_subject_id' => $subject['subject_id'],
                            'academic_level_id'   => $levelId,
                        ]);
                    }

                }
            }

            DB::commit();

            return response()->json(['custom' => $assign->custom], 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['message' => 'Something is wrong there'], 503);
        }
    }

    /**
     * @param $custom
     */
    public function showAssignList($custom) {

        return $assign = SubjectAssign::whereCustom($custom)->with([
            'academicSession:id,title,duration',
            'lists.teacher:id,name',
            'lists.teacher.teacher:id,user_id,code',
            'lists.day:id,name',
            'lists.academicSubject:id,name,code',
            'lists.period:id,title,show',
            'academicLevel',
        ])->firstOrFail();
    }

    /**
     * @return mixed
     */
    public function subjectAssignList() {
        $data = SubjectAssign::with([
            'academicSession:id,duration',
            'academicLevel',
        ])->orderBy('id', 'desc')->get();

        return datatables()->of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->toDateTime();
            })
            ->editColumn('session_id', function ($row) {
                return $row->academicSession->duration;
            })
            ->addColumn('academic_details', function ($row) {
                return $row->academicLevel->details['details'];
            })
            ->addColumn('action', function ($row) {
                return '<button data-id="' . $row->custom . '" data-action="show" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> ' . __('show') . '</button>';
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    /**
     * @param $custom
     */
    public function subjectAssignDelete($custom) {

        /* try { */
        DB::beginTransaction();

        $assign = SubjectAssign::whereCustom($custom)->firstOrFail();
        //$assign->lists()->delete();
        $assign->delete();

        DB::commit();

        /* return response()->json(['message' => 'Successfully Accepted'], 200);
    } catch (\Exception $e) {
    DB::rollback();

    return response()->json(['message' => 'Something is wrong there'], 503);
    } */

    }
}
