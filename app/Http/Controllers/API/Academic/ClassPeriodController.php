<?php

namespace App\Http\Controllers\API\Academic;

use App\Http\Controllers\Controller;
use App\Models\ClassPeriod;
use Illuminate\Http\Request;

class ClassPeriodController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Super Admin|Admin']);
    }

    public function index()
    {
        return ClassPeriod::get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:class_periods',
            'start' => 'required',
            'end' => 'required'
        ]);

        $in = $request->all();
        $in['show'] = $request->input("start") . '-' . $request->input("end");
        ClassPeriod::create($in);
    }

    public function update(Request $request, $id)
    {
        $classPeriod = ClassPeriod::findOrFail($id);
        $request->validate([
            'title' => 'required|unique:class_periods,title,'.$id,
            'start' => 'required',
            'end' => 'required'
        ]);

        $in = $request->all();
        $in['show'] = $request->input("start") . '-' . $request->input("end");
        $classPeriod->update($in);
    }

}
