<?php

namespace App\Http\Controllers\API\Academic;

use App\Http\Controllers\Controller;
use App\Models\AcademicDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Super Admin|Admin|Register']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AcademicDepartment::with(['sections:id,name'])->orderByDesc('id')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:academic_departments',
            'academic_year_ids' => 'required|array',
            'academic_year_ids.*' => 'required'
        ]);
        $department = AcademicDepartment::create($request->all());
        $department->sections()->attach($request->input('academic_year_ids'));
        Cache::forget('departmentList');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $department = AcademicDepartment::find($id);
        $request->validate([
            'name' => 'required|unique:academic_departments,name,'.$id,
            'academic_year_ids' => 'required|array',
            'academic_year_ids.*' => 'required'
        ]);
        $department->update($request->all());
        $department->sections()->sync($request->input('academic_year_ids'));
        Cache::forget('departmentList');
    }

}
