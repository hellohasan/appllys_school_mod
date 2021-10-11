<?php

namespace App\Http\Controllers\API;

use App\Models\SalaryScale;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class SalaryScaleController extends Controller {
    public function __construct() {
        $this->middleware(['role:Super Admin|Admin', 'permission:salary-scale-create|salary-scale-edit|salary-scale-update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return SalaryScale::withCount('users')->withSum('salaries', 'amount')->orderByDesc('id')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'title'  => 'required|unique:salary_scales',
            'amount' => 'required|numeric',
        ]);

        return SalaryScale::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $scale = SalaryScale::findOrFail($id);
        $request->validate([
            'title'  => 'required|unique:salary_scales,title,' . $id,
            'amount' => 'required|numeric',
        ]);

        $scale->update($request->all());

        return $scale;
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
}
