<?php

namespace App\Http\Controllers\API\Academic;

use App\Http\Controllers\Controller;
use App\Models\AcademicSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SectionController extends Controller
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
        return AcademicSection::all();
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
            'name' => 'required|unique:academic_sections,name',
            'seat' => 'required|numeric'
        ]);
        AcademicSection::create($request->all());
        Cache::forget('sectionList');
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
        $section = AcademicSection::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:academic_sections,name,'.$id,
            'seat' => 'required|numeric'
        ]);

        $section->update($request->all());
        Cache::forget('sectionList');
    }
}
