<?php

namespace App\Http\Controllers;

use App\Models\AcademicClass;
use App\Models\AcademicClassSession;
use App\Models\AcademicData;
use App\Models\AcademicDepartment;
use App\Models\AcademicGroup;
use App\Models\AcademicSection;
use App\Models\AcademicSession;
use App\Models\AcademicSubject;
use App\Models\AcademicYear;
use App\Models\BillItem;
use App\Models\BloodGroup;
use App\Models\Designation;
use App\Models\District;
use App\Models\Division;
use App\Models\Religion;
use App\Models\SalaryScale;
use App\Models\Upazila;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
    public function loadReligionList()
    {
        return Religion::select(['id', 'name as text'])->get();
    }

    public function loadBloodList()
    {
        return BloodGroup::pluck('name')->toArray();
    }

    public function loadClassList()
    {
        return AcademicClass::select(['id', 'name as text'])->whereStatus(1)->get();
    }

    public function loadClassGroupDepartment(Request $request)
    {
        $classId = $request->input("id");
        return AcademicClass::select(['id', 'type'])
            ->with([
                'academicDepartments:id,name as text',
                'academicGroups:id,name as text',
            ])
            ->findOrFail($classId);
    }

    public function loadDepartmentYears(Request $request)
    {
        $departmentId = $request->input("id");
        return AcademicDepartment::select(['id'])
            ->with([
                'sections:id,name as text',
            ])
            ->findOrFail($departmentId);
    }

    public function searchClassSubject(Request $request)
    {
        $request->validate([
            'academic_class_id' => 'required',
            'academic_class_type' => 'required',
            'academic_group_id' => 'required_if:academic_class_type,1',
            'academic_department_id' => 'required_if:academic_class_type,2',
            'academic_section_id' => 'required_if:academic_class_type,2',
        ]);

        if ($request->input("academic_class_type") == 2) {
            $subjects = AcademicSubject::with(['religion'])
                ->where('academic_class_id', $request->input("academic_class_id"))
                ->where('academic_department_id', $request->input("academic_department_id"))
                ->where('academic_section_id', $request->input("academic_section_id"))
                ->get();
        } elseif ($request->input("academic_class_type") == 1) {
            $subjects = AcademicSubject::with(['religion'])
                ->where('academic_class_id', $request->input("academic_class_id"))
                ->where('academic_group_id', $request->input("academic_group_id"))
                ->get();
        } else {
            $subjects = AcademicSubject::with(['religion'])
                ->where('academic_class_id', $request->input("academic_class_id"))
                ->get();
        }
        return $subjects;
    }

    public function loadOnlyClassList()
    {
        return AcademicClass::select(['name as text', 'id'])->get();
    }

    public function loadOnlySessionList()
    {
        return AcademicSession::select(['id', 'duration as text'])->orderByDesc('id')->get();
    }

    public function loadClassWithSession($sessionId)
    {
        return AcademicSession::select(['id'])
            ->with(['academic_classes:id,name as text,type'])->findOrFail($sessionId);
    }

    public function loadClassSectionGroupDepartment(Request $request)
    {

        $classId = $request->input("id");
        $data['class'] = AcademicClass::select(['id', 'type'])
            ->with([
                'sections:id,name as text',
                'academicDepartments:id,name as text',
                'academicGroups:id,name as text',
            ])
            ->findOrFail($classId);

        $data['fee'] = AcademicClassSession::where('academic_class_id', $classId)
            ->where('academic_session_id', $request->input("session_id"))
            ->firstOrFail()
            ->admission_fee;

        return $data;

    }

    public function loadGroupSection(Request $request)
    {
        $groupId = $request->input("id");
        $classId = $request->input("classId");

        $data['optionals'] = AcademicSubject::whereAcademicClassId($classId)
            ->whereAcademicGroupId($groupId)
            ->whereSubjectType(1)
            ->select(['id', 'name as text'])
            ->get();

        $data['groups'] = AcademicGroup::select(['id'])
            ->with(['sections:id,name as text'])
            ->findOrFail($groupId);
        return $data;
    }

    public function loadDivisions()
    {
        return Division::select(['id', 'name as text'])->get();
    }

    public function loadDistricts(Request $request)
    {
        return District::select(['id', 'name as text'])->where('division_id', $request->input("id"))->get();
    }

    public function loadUpazilas(Request $request)
    {
        return Upazila::select(['id', 'name as text'])->where('district_id', $request->input("id"))->get();
    }

    public function loadGuardians()
    {
        //return User::all();
        //return User::role(['Guardian'])->select(['id','name as text'])->get();
        //return User::role(['Guardian'])->select(['id','name as text'])->get();
        return User::select([DB::raw('CONCAT(name," (",phone,")") AS text'), 'id'])->get();
    }

    public function loadAdmissionDetails(Request $request)
    {
        $request->validate([
            'custom' => 'required',
        ]);
        $custom = $request->input("custom");
        return User::whereCustom($custom)
            ->with([
                'information',
                'information.religion:id,name',
                'father',
                'mother',
                'guardian.guardianInformation',
                'familyInfo',
                'address',
                'address.division:id,name',
                'address.district:id,name',
                'address.upazila:id,name',
                'address.presentDivision:id,name',
                'address.presentDistrict:id,name',
                'address.presentUpazila:id,name',
                'admission.academic',
                'admission.academic.session:id,duration',
                'admission.academic.class:id,name,code',
                'admission.academic.section:id,name',
                'admission.academic.year:id,name',
                'admission.academic.optionalSubject.academicSubject:id,name',
                'previousInstitute',
                'documents',
            ])
            ->firstOrFail();

    }

    public function loadAcademicGroupList()
    {
        return AcademicGroup::where('id', '!=', 14)->whereStatus(1)->select(['id', 'name as text'])->get();
    }
    public function loadAcademicGroupAllList()
    {
        return AcademicGroup::whereStatus(1)->select(['id', 'name as text'])->get();
    }

    public function loadAcademicDepartmentList()
    {
        return AcademicDepartment::whereStatus(1)->select(['id', 'name as text'])->get();
    }

    public function loadAcademicYearList()
    {
        return AcademicYear::whereStatus(1)->select(['id', 'name as text'])->get();
    }

    public function loadAcademicSectionList()
    {
        return AcademicSection::whereStatus(1)->select(['id', 'name as text'])->get();
    }

    public function loadSalaryScaleList()
    {
        return SalaryScale::whereStatus(1)->select(['id', DB::raw('CONCAT(title," (",amount,")") AS text')])->get();
    }

    public function loadDesignationList()
    {
        return Designation::whereStatus(1)->select(['id', 'title as text'])->get();
    }

    public function loadBillForStudent()
    {
        return BillItem::select(['id','title as text','default_amount as amount'])->where('item_for','Students')->whereActivated(1)->get();
    }

    public function loadStudentForClass(Request $request)
    {
        if ($request->has('class_id')) {
            $session = AcademicSession::whereIscurrent(1)->first();
            $students = AcademicData::whereAcademicSessionId($session->id)
                ->whereAcademicClassId($request->get("class_id"))
                ->pluck('user_id')
                ->toArray();
            return User::whereIn('id',$students)
                ->select(['id',DB::raw('CONCAT("(",custom,") ",name) AS text')])
                ->get();
        }
    }

    public function loadStudentForClassGroup(Request $request)
    {
        if ($request->has('class_id') && $request->has('group_id')) {
            $session = AcademicSession::whereIscurrent(1)->first();
            $students = AcademicData::whereAcademicSessionId($session->id)
                ->whereAcademicClassId($request->get("class_id"))
                ->whereAcademicGroupId($request->get("group_id"))
                ->pluck('user_id')
                ->toArray();
            return User::whereIn('id',$students)
                ->select(['id',DB::raw('CONCAT("(",custom,") ",name) AS text')])
                ->get();
        }
    }

    public function loadStudentForClassDepartmentYear(Request $request)
    {
        if ($request->has('class_id') && $request->has('department_id') && $request->has('year_id')) {
            $session = AcademicSession::whereIscurrent(1)->first();
            $students = AcademicData::whereAcademicSessionId($session->id)
                ->whereAcademicClassId($request->get("class_id"))
                ->whereAcademicDepartmentId($request->get("department_id"))
                ->whereAcademicYearId($request->get("year_id"))
                ->pluck('user_id')
                ->toArray();
            return User::whereIn('id',$students)
                ->select(['id',DB::raw('CONCAT("(",custom,") ",name) AS text')])
                ->get();
        }
    }

}
