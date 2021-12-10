<?php

namespace App\Http\Controllers\API\Academic;

use Carbon\Carbon;
use App\Models\Day;
use Illuminate\Http\Request;
use App\Models\SubjectAssign;
use App\Models\TeacherSubject;
use App\Models\AcademicSession;
use App\Models\AcademicSubject;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SubjectAssignController extends Controller {
    public function __construct() {
        // middleware goes here

    }

    /**
     * @param Request $request
     */
    public function getSubjectList(Request $request) {

        $type = $request->input("academic_class_type");

        $subjects = AcademicSubject::query();
        $session = AcademicSession::where('isCurrent', 1)->first();
        $days = Day::where('name', '!=', $session->off_day)->get();

        $subjects->select([
            'id',
            'academic_class_id',
            'academic_class_type',
            'academic_group_id',
            'academic_section_id',
            'academic_department_id',
            'academic_year_id',
            'name',
            'code',
            'subject_type',
            'point',
        ]);
        $previous = SubjectAssign::query();
        $previous = $previous->whereSessionId($request->input("session_id"))
            ->whereAcademicClassId($request->input("academic_class_id"));
        if ($type == 0) {
            $previous = $previous->whereAcademicSectionId($request->input("academic_section_id"));
            $subjects = $subjects->whereAcademicClassId($request->input("academic_class_id"))->get();
        } elseif ($type == 1) {
            $previous = $previous->whereAcademicGroupId($request->input("academic_group_id"))->whereAcademicGroupSectionId($request->input("academic_group_section_id"));
            $subjects = $subjects->whereAcademicClassId($request->input("academic_class_id"))
                ->whereAcademicGroupId($request->input("academic_group_id"))
                ->get();
        } else {
            $previous = $previous->whereAcademicDepartmentId($request->input("academic_department_id"))->whereAcademicYearId($request->input("academic_year_id"));
            $subjects = $subjects->whereAcademicClassId($request->input("academic_class_id"))
                ->whereAcademicDepartmentId($request->input("academic_department_id"))
                ->whereAcademicYearId($request->input("academic_year_id"))
                ->get();
        }

        $previous = $previous->first();
        $data['custom'] = $previous ? $previous->custom : '';
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
                $assign = SubjectAssign::create([
                    "session_id"                => $request->input("session_id"),
                    'academic_class_id'         => $request->input("academic_class_id"),
                    'type'                      => $type,
                    'academic_section_id'       => $type == 0 ? $request->input("academic_section_id") : null,
                    'academic_group_id'         => $type == 1 ? $request->input("academic_group_id") : null,
                    'academic_group_section_id' => $type == 1 ? $request->input("academic_group_section_id") : null,
                    'academic_department_id'    => $type == 2 ? $request->input("academic_department_id") : null,
                    'academic_year_id'          => $type == 2 ? $request->input("academic_year_id") : null,
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
            'academicClass:id,name',
            'section:id,name',
            'group:id,name',
            'groupSection:id,name',
            'department:id,name',
            'year:id,name',
            'lists.teacher:id,name',
            'lists.teacher.teacher:id,user_id,code',
            'lists.day:id,name',
            'lists.academicSubject:id,name,code',
            'lists.period:id,title,show',
        ])->firstOrFail();
    }

    /**
     * @return mixed
     */
    public function subjectAssignList() {
        $data = SubjectAssign::with([
            'academicSession:id,duration',
            'academicClass:id,name',
            'group:id,name',
            'department:id,name',
            'groupSection:id,name',
            'year:id,name',
            'section:id,name',
        ])->orderBy('id', 'desc')->get();

        return datatables()->of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->toDateTime();
            })
            ->editColumn('session_id', function ($row) {
                return $row->academicSession->duration;
            })
            ->editColumn('academic_class_id', function ($row) {
                return $row->academicClass->name;
            })
            ->addColumn('group_or_department', function ($row) {
                if ($row->type == 1) {
                    $gd = $row->group->name;
                } elseif ($row->type == 2) {
                    $gd = $row->department->name;
                } else {
                    $gd = 'N/A';
                }

                return $gd;
            })
            ->addColumn('section_or_year', function ($row) {
                if ($row->type == 1) {
                    $gd = $row->groupSection->name;
                } elseif ($row->type == 2) {
                    $gd = $row->year->name;
                } else {
                    $gd = $row->section->name;
                }

                return $gd;
            })
            ->addColumn('action', function ($row) {
                return '<button data-id="' . $row->custom . '" data-action="show" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> ' . __('show') . '</button> <button data-id="' . $row->custom . '" data-action="delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> ' . __('delete') . '</button>';
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    /**
     * @param $custom
     */
    public function subjectAssignDelete($custom) {

        try {
            DB::beginTransaction();

            $assign = SubjectAssign::whereCustom($custom)->firstOrFail();
            $assign->lists()->delete();
            $assign->delete();

            DB::commit();

            return response()->json(['message' => 'Successfully Accepted'], 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['message' => 'Something is wrong there'], 503);
        }

    }
}
