<?php

namespace App\Http\Controllers\API\Academic;

use App\Http\Controllers\Controller;
use App\Models\AcademicClass;
use App\Models\AcademicGrade;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'role:Super Admin|Admin|Register',
            'permission:class-create|class-edit|class-list|class-details',
        ]);
    }

    public function loadAcademicGrading()
    {
        return AcademicGrade::select(['id', 'name as text'])->whereStatus(1)->get();
    }

    public function storeAcademicClass(Request $request)
    {

        $request->validate([
            "name" => "required|max:100|unique:academic_classes,name",
            "code" => "required|max:50|unique:academic_classes,code",
            'type' => "required",
            'academic_grading_id' => 'required',
            'academic_department_ids' => 'required_if:type,2|array',
            'academic_department_ids.*' => 'required_if:type,2',

            'academic_group_ids' => 'required_if:type,1|array',
            'academic_group_ids.*' => 'required_if:type,1',

            'academic_section_ids' => 'required_if:type,0|array',
            'academic_section_ids.*' => 'required_if:type,0',
        ]);

        try {
            DB::beginTransaction();

            $in = $request->except(['academic_group_ids', 'academic_section_ids', 'academic_department_ids']);
            $academicClass = AcademicClass::create($in);

            if ($request->input("type") == 2)
            {
                $academicClass->academicDepartments()->attach($request->input("academic_department_ids"));
            }
            elseif ($request->input("type") == 1)
            {
                $academicClass->academicGroups()->attach($request->input("academic_group_ids"));
            }
            else
            {
                $academicClass->sections()->attach($request->input("academic_section_ids"));
            }

            DB::commit();
            Cache::forget('classList');
            Cache::forget('onlyClassList');
        }
        catch (Exception $e)
        {
            DB::rollback();
        }
    }

    public function getAcademicClass()
    {
        return AcademicClass::with([
            'grading:name,id',
            'sections:id,name,status',

            'academicGroups:id,name,status',
            'academicGroups.sections:id,name,status',

            'academicDepartments:id,name,status',
            'academicDepartments.sections:id,name,status',
        ])->get();

    }

    public function editAcademicClass($id)
    {
        return AcademicClass::with([
            'grading:name,id',
            'sections:id,name,status',

            'academicGroups:id,name,status',
            'academicGroups.sections:id,name,status',

            'academicDepartments:id,name,status',
            'academicDepartments.sections:id,name,status',
        ])->findOrFail($id);
    }

    public function updateAcademicClass(Request $request, $id)
    {
        $cls = AcademicClass::findOrFail($id);
        $request->validate([
            "name" => "required|max:100|unique:academic_classes,name," . $id,
            "code" => "required|max:50|unique:academic_classes,code," . $id,
            'academic_grading_id' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $cls->update($request->all());

            if ($cls->type == 2)
            {
                $cls->academicDepartments()->sync($request->input("academic_department_ids"));
            }
            elseif ($cls->type == 1)
            {
                $cls->academicGroups()->sync($request->input("academic_group_ids"));
            }
            else
            {
                $cls->sections()->sync($request->input("academic_section_ids"));
            }

            DB::commit();
            Cache::forget('classList');
            Cache::forget('onlyClassList');
        }
        catch (\Exception $e)
        {
            DB::rollback();
            return $e;
        }
    }

    public function editAcademicClassDetails($id)
    {
        $cl = AcademicClass::with([
            'sections',
            'academicDepartments', 'academicDepartments.sections',
            'academicGroups', 'academicGroups.sections',
        ])->findOrFail($id);

        $arr = [];
        $arr['id'] = $cl->id;
        $arr['type'] = $cl->type;
        $arr['name'] = $cl->name;

        if ($cl->type === 2)
        {
            $arr['departments'] = [];
            foreach ($cl->academicDepartments as $department)
            {
                $arr['departments'][] = $department;
            }
        }
        elseif ($cl->type === 1)
        {
            $arr['groups'] = [];
            foreach ($cl->academicGroups as $group)
            {
                $arr['groups'][] = $group;
            }
        }
        else
        {
            foreach ($cl->sections as $section)
            {
                $arr['sections'][] = $section;
            }
        }
        return Response::json($arr, 200);
    }
}
