<?php

namespace App\Http\Controllers\API\Academic;

use App\Http\Controllers\Controller;
use App\Models\AcademicSubject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct()
    {

    }

    public function storeSubject(Request $request)
    {

        $rules = [
            'academic_class_id' => 'required',
            'academic_class_type' => 'required',
            'academic_group_id' => 'required_if:academic_class_type,1',
            'academic_department_id' => 'required_if:academic_class_type,2',
            'academic_section_id' => 'required_if:academic_class_type,2',
        ];

        if ($request->input("academic_class_type") == 1) {
            $rules = array_merge($rules,[
                'name' => 'required|max:191|unique_with:academic_subjects,academic_class_id,academic_group_id',
                'code' => 'required|max:191|unique_with:academic_subjects,academic_class_id,academic_group_id'
            ]);
        }elseif ($request->input("academic_class_type") == 2) {
            $rules = array_merge($rules,[
                'name' => 'required|max:191|unique_with:academic_subjects,academic_class_id,academic_department_id,academic_section_id',
                'code' => 'required|max:191|unique_with:academic_subjects,academic_class_id,academic_department_id,academic_section_id'
            ]);
        }else{
            $rules = array_merge($rules,[
                'name' => 'required|max:191|unique_with:academic_subjects,academic_class_id',
                'code' => 'required|max:191|unique_with:academic_subjects,academic_class_id',
            ]);
        }

        $rules = array_merge($rules,[
            'mark_type' => 'required',
            'full_mark' => 'required_if:mark_type,0|nullable|numeric',
            'theory' => 'required_if:mark_type,1|nullable|numeric',
            'practical' => 'required_if:mark_type,1|nullable|numeric',
            'subject_type' => 'required',
            'point' => 'required_if:subject_type,0|nullable|numeric',
            'total_point' => 'required_if:subject_type,1|nullable|numeric',
            'optional_point' => 'required_if:subject_type,1|nullable|numeric',
            'religion_type' => 'required',
            'religion_id' => 'required_if:religion_type,1'
        ]);

        $request->validate($rules);

        $in = $request->except([
            'academic_group_id',
            'academic_department_id',
            'academic_section_id',
            'full_mark',
            'theory',
            'practical',
            'point',
            'total_point',
            'optional_point',
            'religion_id'
        ]);

        if ($request->input("academic_class_type") == 1) {
            $in['academic_group_id'] = $request->input("academic_group_id");
        }else{
            $in['academic_department_id'] = $request->input("academic_department_id");
            $in['academic_section_id'] = $request->input("academic_section_id");
        }

        if ($request->input("mark_type")) {
            $in['theory'] = $request->input("theory");
            $in['practical'] = $request->input("practical");
            $in['full_mark'] = $request->input("theory") + $request->input("practical");
        }else{
            $in['full_mark'] = $request->input("full_mark");
        }

        if ($request->input("subject_type")) {
            $in['total_point'] = $request->input("total_point");
            $in['optional_point'] = $request->input("optional_point");
        }else{
            $in['point'] = $request->input("point");
        }

        if ($request->input("religion_type")) {
            $in['religion_id'] = $request->input("religion_id");
        }

        AcademicSubject::create($in);

    }

    public function editSubject($id)
    {
        return AcademicSubject::with([
            'academic_class',
            'academic_group',
            'academic_department',
            'academic_section',
        ])->findOrFail($id);
    }

    public function updateSubject(Request $request, $id)
    {
        $subject = AcademicSubject::findOrFail($id);

        $rules = [];
        if ($request->input("academic_class_type") == 1) {
            $rules = array_merge($rules,[
                'name' => 'required|max:191|unique_with:academic_subjects,academic_class_id,academic_group_id,'.$id,
                'code' => 'required|max:191|unique_with:academic_subjects,academic_class_id,academic_group_id,'.$id
            ]);
        }elseif ($request->input("academic_class_type") == 2) {
            $rules = array_merge($rules,[
                'name' => 'required|max:191|unique_with:academic_subjects,academic_class_id,academic_department_id,academic_section_id,'.$id,
                'code' => 'required|max:191|unique_with:academic_subjects,academic_class_id,academic_department_id,academic_section_id,'.$id
            ]);
        }else{
            $rules = array_merge($rules,[
                'name' => 'required|max:191|unique_with:academic_subjects,academic_class_id,ignore:'.$id,
                'code' => 'required|max:191|unique_with:academic_subjects,academic_class_id,ignore:'.$id,
            ]);
        }

        $rules = array_merge($rules,[
            'mark_type' => 'required',
            'full_mark' => 'required_if:mark_type,0|nullable|numeric',
            'theory' => 'required_if:mark_type,1|nullable|numeric',
            'practical' => 'required_if:mark_type,1|nullable|numeric',
            'subject_type' => 'required',
            'point' => 'required_if:subject_type,0|nullable|numeric',
            'total_point' => 'required_if:subject_type,1|nullable|numeric',
            'optional_point' => 'required_if:subject_type,1|nullable|numeric',
            'religion_type' => 'required',
            'religion_id' => 'required_if:religion_type,1'
        ]);

        $request->validate($rules);

        $in = $request->except([
            'academic_group_id',
            'academic_department_id',
            'academic_section_id',
            'full_mark',
            'theory',
            'practical',
            'point',
            'total_point',
            'optional_point',
            'religion_id'
        ]);

        if ($request->input("academic_class_type") === 1) {
            $in['academic_group_id'] = $request->input("academic_group_id");
        }elseif($request->input("academic_class_type") === 2){
            $in['academic_department_id'] = $request->input("academic_department_id");
            $in['academic_section_id'] = $request->input("academic_section_id");
        }

        if ($request->input("mark_type")) {
            $in['theory'] = $request->input("theory");
            $in['practical'] = $request->input("practical");
            $in['full_mark'] = $request->input("theory") + $request->input("practical");
        }else{
            $in['full_mark'] = $request->input("full_mark");
        }

        if ($request->input("subject_type")) {
            $in['total_point'] = $request->input("total_point");
            $in['optional_point'] = $request->input("optional_point");
        }else{
            $in['point'] = $request->input("point");
        }

        if ($request->input("religion_type")) {
            $in['religion_id'] = $request->input("religion_id");
        }

        $subject->update($in);

    }
}
