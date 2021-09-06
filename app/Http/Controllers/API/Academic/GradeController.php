<?php

namespace App\Http\Controllers\API\Academic;

use App\Models\AcademicGrade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    public function __construct()
    {

    }

    public function storeGrade(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:academic_grades',
            'grades' => 'required|array',
            'grades.*.name' => 'required|max:20',
            'grades.*.min_percentage' => 'required|numeric',
            'grades.*.max_percentage' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $grade = AcademicGrade::create([
                'name' => $request->input("name"),
                'status' => $request->input("status")
            ]);
            foreach ($request->input("grades") as $percent) {
                $grade->percentages()->create([
                    'name' => $percent["name"],
                    'min_percentage' => $percent["min_percentage"],
                    'max_percentage' => $percent["max_percentage"],
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }
    }

    public function getGradeList()
    {
        return AcademicGrade::select(['id','name','status'])->with(['percentages:name,min_percentage,max_percentage,academic_grade_id'])->get();
    }

    public function editGradeList($id)
    {
        return AcademicGrade::select(['id','name','status'])->with(['percentages:name,min_percentage,max_percentage,academic_grade_id'])->findOrFail($id);
    }

    public function updateGradeList(Request $request,$id)
    {
        $grade = AcademicGrade::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:academic_grades,name,'.$id,
            'percentages' => 'required|array',
            'percentages.*.name' => 'required|max:20',
            'percentages.*.min_percentage' => 'required|numeric',
            'percentages.*.max_percentage' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $grade->update([
                'name' => $request->input("name"),
                'status' => $request->input("status")
            ]);

            $grade->percentages()->delete();

            foreach ($request->input("percentages") as $percent) {
                $grade->percentages()->updateOrCreate([
                    'name' => $percent["name"],
                    'min_percentage' => $percent["min_percentage"],
                    'max_percentage' => $percent["max_percentage"],
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }
    }

}
