<?php

namespace App\Http\Controllers\API\Academic;

use Response;
use Illuminate\Http\Request;
use App\Models\AcademicLevel;
use App\Models\AcademicSubject;
use App\Http\Traits\HelperTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AcademicSubjectLevel;

class SubjectController extends Controller {
    use HelperTrait;
    public function __construct() {

    }

    /**
     * @param Request $request
     */
    public function storeSubject(Request $request) {

        $rules = [
            'academic_class_id'      => 'required',
            'academic_class_type'    => 'required',
            'academic_group_id'      => 'required_if:academic_class_type,1',
            'academic_department_id' => 'required_if:academic_class_type,2',
            'academic_year_id'       => 'required_if:academic_class_type,2',
            'name'                   => 'required|max:191',
            'code'                   => 'required|max:30',
            'mark_type'              => 'required',
            'full_mark'              => 'required_if:mark_type,0|nullable|numeric',
            'theory'                 => 'required_if:mark_type,1|nullable|numeric',
            'practical'              => 'required_if:mark_type,1|nullable|numeric',
            'subject_type'           => 'required',
            'point'                  => 'required_if:subject_type,0|nullable|numeric',
            'total_point'            => 'required_if:subject_type,1|nullable|numeric',
            'optional_point'         => 'required_if:subject_type,1|nullable|numeric',
            'religion_type'          => 'required',
            'religion_id'            => 'required_if:religion_type,1',
        ];

        $request->validate($rules);

        try {
            DB::beginTransaction();

            $in = $request->except([
                'academic_class_id',
                'academic_class_type',
                'academic_group_id',
                'academic_department_id',
                'academic_year_id',
                'full_mark',
                'theory',
                'practical',
                'point',
                'total_point',
                'optional_point',
                'religion_id',
            ]);

            if ($request->input("mark_type")) {
                $in['theory'] = $request->input("theory");
                $in['practical'] = $request->input("practical");
                $in['full_mark'] = $request->input("theory") + $request->input("practical");
            } else {
                $in['full_mark'] = $request->input("full_mark");
            }

            if ($request->input("subject_type")) {
                $in['total_point'] = $request->input("total_point");
                $in['optional_point'] = $request->input("optional_point");
            } else {
                $in['point'] = $request->input("point");
            }

            if ($request->input("religion_type")) {
                $in['religion_id'] = $request->input("religion_id");
            }

            $subject = AcademicSubject::create($in);

            if ($request->input("academic_class_type") == 1) {
                $levels = AcademicLevel::whereType($request->input("academic_class_type"))->whereAcademicClassId($request->input("academic_class_id"))->whereLevelOneId($request->input("academic_group_id"))->get();
            } elseif ($request->input("academic_class_type") == 2) {
                $levels = AcademicLevel::whereType($request->input("academic_class_type"))->whereAcademicClassId($request->input("academic_class_id"))->whereLevelOneId($request->input("academic_department_id"))->whereLevelTwoId($request->input("academic_year_id"))->get();
            } else {
                $levels = AcademicLevel::whereType($request->input("academic_class_type"))->whereAcademicClassId($request->input("academic_class_id"))->get();
            }
            foreach ($levels as $level) {
                $subject->levels()->create([
                    'academic_class_id' => $request->input("academic_class_id"),
                    'academic_level_id' => $level->id,
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Successfully Accepted'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Something is wrong there'], 503);
        }
    }

    /**
     * @param $id
     */
    public function editSubject($id) {
        $level = AcademicSubjectLevel::find($id);
        $data['subject'] = $level->subject;
        $acLevel = $level->level;
        $data['academic_class_id'] = $acLevel->academic_class_id;
        if ($acLevel->type == 2) {
            $data['academic_class_type'] = 2;
            $data['academic_department_id'] = (string) $acLevel->level_one_id;
            $data['academic_year_id'] = (string) $acLevel->level_two_id;
        } elseif ($acLevel->type == 1) {
            $data['academic_class_type'] = 1;
            $data['academic_group_id'] = (string) $acLevel->level_one_id;
        } else {
            $data['academic_class_type'] = 0;
        }

        return Response::json($data, 200);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function updateSubject(Request $request, $id) {

        $subjectLevel = AcademicSubjectLevel::find($id);
        $subject = AcademicSubject::find($subjectLevel->academic_subject_id);

        $rules = [
            'academic_class_id'      => 'required',
            'academic_class_type'    => 'required',
            'academic_group_id'      => 'required_if:academic_class_type,1',
            'academic_department_id' => 'required_if:academic_class_type,2',
            'academic_year_id'       => 'required_if:academic_class_type,2',
            'name'                   => 'required|max:191',
            'code'                   => 'required|max:30',
            'mark_type'              => 'required',
            'full_mark'              => 'required_if:mark_type,0|nullable|numeric',
            'theory'                 => 'required_if:mark_type,1|nullable|numeric',
            'practical'              => 'required_if:mark_type,1|nullable|numeric',
            'subject_type'           => 'required',
            'point'                  => 'required_if:subject_type,0|nullable|numeric',
            'total_point'            => 'required_if:subject_type,1|nullable|numeric',
            'optional_point'         => 'required_if:subject_type,1|nullable|numeric',
            'religion_type'          => 'required',
            'religion_id'            => 'required_if:religion_type,1',
        ];

        $request->validate($rules);

        $in = $request->except([
            'academic_group_id',
            'academic_department_id',
            'academic_year_id',
            'full_mark',
            'theory',
            'practical',
            'point',
            'total_point',
            'optional_point',
            'religion_id',
        ]);

        if ($request->input("mark_type")) {
            $in['theory'] = $request->input("theory");
            $in['practical'] = $request->input("practical");
            $in['full_mark'] = $request->input("theory") + $request->input("practical");
        } else {
            $in['full_mark'] = $request->input("full_mark");
        }

        if ($request->input("subject_type")) {
            $in['total_point'] = $request->input("total_point");
            $in['optional_point'] = $request->input("optional_point");
        } else {
            $in['point'] = $request->input("point");
        }

        if ($request->input("religion_type")) {
            $in['religion_id'] = $request->input("religion_id");
        }

        $subject->update($in);

        $subject->levels()->delete();

        if ($request->input("academic_class_type") == 1) {
            $levels = AcademicLevel::whereType($request->input("academic_class_type"))->whereAcademicClassId($request->input("academic_class_id"))->whereLevelOneId($request->input("academic_group_id"))->get();
        } elseif ($request->input("academic_class_type") == 2) {
            $levels = AcademicLevel::whereType($request->input("academic_class_type"))->whereAcademicClassId($request->input("academic_class_id"))->whereLevelOneId($request->input("academic_department_id"))->whereLevelTwoId($request->input("academic_year_id"))->get();
        } else {
            $levels = AcademicLevel::whereType($request->input("academic_class_type"))->whereAcademicClassId($request->input("academic_class_id"))->get();
        }
        foreach ($levels as $level) {
            $subject->levels()->create([
                'academic_class_id' => $request->input("academic_class_id"),
                'academic_level_id' => $level->id,
            ]);
        }

    }
}
