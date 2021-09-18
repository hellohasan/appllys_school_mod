<?php

namespace App\Http\Controllers\API\Accountant;

use App\Http\Controllers\Controller;
use App\Models\AcademicData;
use App\Models\AcademicSession;
use App\Models\BillPackage;
use App\Models\BillStudent;
use Illuminate\Http\Request;

class BillAssignController extends Controller
{

    public function __construct()
    {
        //$this->middleware('permission:bill-assign-view',['only'=>['billAssignView']]);
    }

    public function billAssignList()
    {
        return BillPackage::orderByDesc('id')
            ->with([
                'academic_session:id,duration',
                'academic_class:id,name',
                'academic_group:id,name',
                'academic_group:id,name',
                'academic_department:id,name',
                'academic_section:id,name',
                'academic_year:id,name',
            ])
            ->withCount('billStudents')
            ->get();
    }

    public function customPad($start,$prefix,$length) {
        return $prefix.(str_pad((int)$start, $length, '0', STR_PAD_LEFT));
    }

    public function billAssignSubmit(Request $request)
    {

        $request->validate([
            'academic_class_id' => 'required',
            'academic_class_type' => 'required',
            'academic_group_id' => 'required_if:academic_class_type,1',
            'academic_department_id' => 'required_if:academic_class_type,2',
            'academic_year_id' => 'required_if:academic_class_type,2',
            'bill_type' => 'required',
            'student_ids' => 'required_if:bill_type,Specific',
            'items' => 'array|required',
            'items.*.amount' => 'required|numeric'
        ]);

        $in = $request->except(['student_ids']);
        $lastPackage = BillPackage::count();
        $in['custom'] = date('Ymd').($this->customPad($lastPackage+1,null,'5'));
        $session = AcademicSession::whereIscurrent(1)->first();
        $in['academic_session_id'] = $session->id;

        $package = BillPackage::create($in);


        if ($request->input("bill_type") == 'Specific') {
            $this->billAssignToStudent($request->input("student_ids"),$package);
        }else {
            $students = [];

            if ($request->academic_class_type == 0) {
                $students = AcademicData::whereAcademicSessionId($session->id)
                    ->whereAcademicClassId($request->get("academic_class_id"))
                    ->pluck('user_id')
                    ->toArray();


            }elseif ($request->academic_class_type == 1) {
                $students = AcademicData::whereAcademicSessionId($session->id)
                    ->whereAcademicClassId($request->get("academic_class_id"))
                    ->whereAcademicGroupId($request->get("academic_group_id"))
                    ->pluck('user_id')
                    ->toArray();
            }elseif ($request->academic_class_type == 2){
                $students = AcademicData::whereAcademicSessionId($session->id)
                    ->whereAcademicClassId($request->get("academic_class_id"))
                    ->whereAcademicDepartmentId($request->get("academic_department_id"))
                    ->whereAcademicYearId($request->get("academic_year_id"))
                    ->pluck('user_id')
                    ->toArray();
            }

            $this->billAssignToStudent($students,$package);
        }

    }

    public function billAssignToStudent($students, $package)
    {
        foreach ($students as $student){
            $bill['user_id'] = $student;
            $bill['bill_package_id'] = $package->id;
            $bill['total'] = $package->total;
            BillStudent::create($bill);
        }
    }

    public function billAssignView($custom)
    {
        $bill = BillPackage::whereCustom($custom)->exists();
        if ($bill) {

            return BillPackage::whereCustom($custom)
                ->with([
                    'academic_session:id,duration',
                    'academic_class:id,name',
                    'academic_group:id,name',
                    'academic_group:id,name',
                    'academic_department:id,name',
                    'academic_section:id,name',
                    'academic_year:id,name',
                ])
                ->withCount('billStudents')
                ->first();

        }else {
            return response(['message' => 'Bill Package not find'],503);
        }
    }

    public function billAssignDelete(Request $request)
    {
        $package = BillPackage::whereCustom($request->input("custom"))->first();
        if ($package) {
            $package->billStudents()->delete();
            $package->delete();
            return response()->json(['message' => 'BillPackage Deleted'],200);
        }else{
            return response()->json(['message' => 'BillPackage Not Found'],503);
        }
    }
}
