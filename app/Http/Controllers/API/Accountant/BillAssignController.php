<?php

namespace App\Http\Controllers\API\Accountant;

use App\Models\BillPackage;
use App\Models\BillStudent;
use App\Models\AcademicData;
use Illuminate\Http\Request;
use App\Models\AcademicSession;
use App\Http\Controllers\Controller;

class BillAssignController extends Controller {

    public function __construct() {
        //$this->middleware('permission:bill-assign-view',['only'=>['billAssignView']]);
    }

    public function billAssignList() {
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

    /**
     * @param $start
     * @param $prefix
     * @param $length
     * @return mixed
     */
    public function customPad($start, $prefix, $length) {
        return $prefix . (str_pad((int) $start, $length, '0', STR_PAD_LEFT));
    }

    /**
     * @param Request $request
     */
    public function billAssignSubmit(Request $request) {

        $request->validate([
            'academic_class_id'      => 'required',
            'academic_class_type'    => 'required',
            'academic_group_id'      => 'required_if:academic_class_type,1',
            'academic_department_id' => 'required_if:academic_class_type,2',
            'academic_year_id'       => 'required_if:academic_class_type,2',
            'bill_type'              => 'required',
            'student_ids'            => 'required_if:bill_type,Specific',
            'items'                  => 'array|required',
            'items.*.amount'         => 'required|numeric',
        ]);

        $in = $request->except(['student_ids']);
        $session = AcademicSession::whereIscurrent(1)->first();
        $in['academic_session_id'] = $session->id;

        $package = BillPackage::create($in);

        if ($request->input("bill_type") == 'Specific') {
            $this->billAssignToStudent($request->input("student_ids"), $package);
        } else {
            $students = [];

            if ($request->academic_class_type == 0) {
                $students = AcademicData::whereAcademicSessionId($session->id)
                    ->whereAcademicClassId($request->get("academic_class_id"))
                    ->pluck('user_id')
                    ->toArray();

            } elseif ($request->academic_class_type == 1) {
                $students = AcademicData::whereAcademicSessionId($session->id)
                    ->whereAcademicClassId($request->get("academic_class_id"))
                    ->whereAcademicGroupId($request->get("academic_group_id"))
                    ->pluck('user_id')
                    ->toArray();
            } elseif ($request->academic_class_type == 2) {
                $students = AcademicData::whereAcademicSessionId($session->id)
                    ->whereAcademicClassId($request->get("academic_class_id"))
                    ->whereAcademicDepartmentId($request->get("academic_department_id"))
                    ->whereAcademicYearId($request->get("academic_year_id"))
                    ->pluck('user_id')
                    ->toArray();
            }

            $this->billAssignToStudent($students, $package);
        }

    }

    /**
     * @param $students
     * @param $package
     */
    public function billAssignToStudent($students, $package) {
        foreach ($students as $student) {
            $bill['user_id'] = $student;
            $bill['custom'] = '1' . str_pad(BillStudent::orderByDesc('id')->first()->id + 1, 7, '0', STR_PAD_LEFT);
            $bill['bill_package_id'] = $package->id;
            $bill['total'] = $package->total;
            $bill['due'] = $package->total;
            BillStudent::create($bill);
        }
    }

    /**
     * @param $custom
     */
    public function billAssignView($custom) {
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

        } else {
            return response(['message' => 'Bill Package not find'], 503);
        }
    }

    /**
     * @param Request $request
     */
    public function billAssignDelete(Request $request) {
        $package = BillPackage::whereCustom($request->input("custom"))->first();
        if ($package) {
            $package->billStudents()->delete();
            $package->delete();

            return response()->json(['message' => 'BillPackage Deleted'], 200);
        } else {
            return response()->json(['message' => 'BillPackage Not Found'], 503);
        }
    }
}
