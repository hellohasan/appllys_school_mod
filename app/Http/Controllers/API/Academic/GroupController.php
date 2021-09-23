<?php

namespace App\Http\Controllers\API\Academic;

use App\Http\Controllers\Controller;
use App\Models\AcademicGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AcademicGroup::with(['sections'])->orderByDesc('id')->get();
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
            'name' => 'required|unique:academic_groups',
            'academic_section_ids' => 'required|array',
            'academic_section_ids.*' => 'required',
        ]);

        $group = AcademicGroup::create($request->all());
        $group->sections()->attach($request->input("academic_section_ids"));
        Cache::forget('groupList');
        Cache::forget('allGroupList');
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
        $group = AcademicGroup::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:academic_groups,name,'.$id,
            'academic_section_ids' => 'required|array',
            'academic_section_ids.*' => 'required',
        ]);

        $group->update($request->all());
        $group->sections()->sync($request->input("academic_section_ids"));
        Cache::forget('groupList');
        Cache::forget('allGroupList');
    }
}
