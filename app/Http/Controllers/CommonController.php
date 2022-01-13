<?php

namespace App\Http\Controllers;

use App\User;
use Response;
use Carbon\Carbon;
use App\Models\Day;
use App\Models\Account;
use App\Models\Upazila;
use App\Models\BillItem;
use App\Models\District;
use App\Models\Division;
use App\Models\Religion;
use App\Models\Admission;
use App\Models\BloodGroup;
use App\Models\ClassPeriod;
use App\Models\Designation;
use App\Models\SalaryScale;
use App\Models\AcademicData;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\AcademicClass;
use App\Models\AcademicGroup;
use App\Models\AcademicLevel;
use App\Models\AcademicSection;
use App\Models\AcademicSession;
use App\Models\AcademicSubject;
use App\Http\Traits\HelperTrait;
use App\Models\AcademicDepartment;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\AcademicClassSession;
use App\Models\AcademicSubjectLevel;
use Illuminate\Support\Facades\Cache;

class CommonController extends Controller {

    use HelperTrait;

    public function loadReligionList() {
        return Cache::rememberForever('religions', function () {
            return Religion::select(['id', 'name as text'])->get();
        });
    }

    public function loadBloodList() {
        return Cache::rememberForever('blood_group', function () {
            return BloodGroup::pluck('name')->toArray();
        });
    }

    public function loadClassList() {
        return Cache::remember('classList', Carbon::now()->addDays(7), function () {
            return AcademicClass::select(['id', 'name as text'])->whereStatus(1)->get();
        });
    }

    /**
     * @param Request $request
     */
    public function loadClassGroupDepartment(Request $request) {
        $classId = $request->input("id");

        return AcademicClass::select(['id', 'type'])
            ->with([
                'academicDepartments:id,name as text',
                'academicGroups:id,name as text',
                'sections:id,name as text',
            ])
            ->findOrFail($classId);
    }

    /**
     * @param Request $request
     */
    public function loadDepartmentYears(Request $request) {
        $departmentId = $request->input("id");

        return AcademicDepartment::select(['id'])
            ->with([
                'sections:id,name as text',
            ])
            ->findOrFail($departmentId);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function searchClassSubject(Request $request) {
        $request->validate([
            'academic_class_id'   => 'required',
            'academic_class_type' => 'required',
            'level_one_id'        => 'required',
            'level_two_id'        => 'required_if:academic_class_type,1,2',
        ]);

        $levelId = $this->findAcademicLevelID($request->input("academic_class_id"), $request->input("academic_class_type"), $request->input("level_one_id"), $request->input("level_two_id"));

        $subjects = AcademicSubjectLevel::with([
            'subject',
            'subject.religion:id,name',
        ])->whereAcademicLevelId($levelId)->get();

        return Response::json($subjects, 200);
    }

    public function loadOnlyClassList() {
        return Cache::remember('onlyClassList', Carbon::parse()->addDays(7), function () {
            return AcademicClass::select(['name as text', 'id'])->get();
        });
    }

    public function loadOnlySessionList() {
        return Cache::remember('onlySessionList', Carbon::parse()->addDays(7), function () {
            return AcademicSession::select(['id', 'duration as text'])->orderByDesc('id')->get();
        });
    }

    /**
     * @param $sessionId
     */
    public function loadClassWithSession($sessionId) {
        return AcademicSession::select(['id'])
            ->with(['academic_classes:id,name as text,type'])->findOrFail($sessionId);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function loadClassSectionGroupDepartment(Request $request) {

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

    /**
     * @param Request $request
     */
    public function loadOnlyGroupSection(Request $request) {
        $groupId = $request->input("id");

        return AcademicGroup::select(['id'])
            ->with(['sections:id,name as text'])
            ->findOrFail($groupId);

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function loadGroupSection(Request $request) {
        $groupId = $request->input("id");
        $classId = $request->input("classId");

        $levelId = AcademicLevel::whereAcademicClassId($classId)->whereLevelOneId($groupId)->first();
        $subjectLevel = AcademicSubjectLevel::whereAcademicLevelId($levelId->id)->pluck('academic_subject_id')->toArray();

        $data['optionals'] = AcademicSubject::whereIn('id', $subjectLevel)
            ->whereSubjectType(1)
            ->select(['id', DB::raw('CONCAT("(",code,") - ",name) as text')])
            ->get();

        $data['groups'] = AcademicGroup::select(['id'])
            ->with(['sections:id,name as text'])
            ->findOrFail($groupId);

        return $data;
    }

    public function loadDivisions() {
        return Cache::rememberForever('divisions', function () {
            return Division::select(['id', 'name as text'])->get();
        });
    }

    /**
     * @param Request $request
     */
    public function loadDistricts(Request $request) {
        return District::select(['id', 'name as text'])->where('division_id', $request->input("id"))->get();
    }

    /**
     * @param Request $request
     */
    public function loadUpazilas(Request $request) {
        return Upazila::select(['id', 'name as text'])->where('district_id', $request->input("id"))->get();
    }

    public function loadGuardians() {
        //return User::all();
        //return User::role(['Guardian'])->select(['id','name as text'])->get();
        //return User::role(['Guardian'])->select(['id','name as text'])->get();
        return User::select([DB::raw('CONCAT(name," (",phone,")") AS text'), 'id'])->get();
    }

    /**
     * @param Request $request
     */
    public function loadAdmissionDetails(Request $request) {
        $request->validate([
            'custom' => 'required',
        ]);
        $custom = $request->input("custom");

        $admission = Admission::whereCustom($custom)->first();

        $data['user'] = User::with([
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
            /* 'admission.academic',
            'admission.academic.session:id,duration',
            'admission.academic.class:id,name,code',
            'admission.academic.section:id,name',
            'admission.academic.year:id,name',*/
            'admission.academic.optionalSubject.academicSubject:id,name',
            'previousInstitute',
            'documents',
        ])->find($admission->user_id);

        $academicData = AcademicData::with([
            'session:id,duration',
            'class:id,name,code,type',
            'level',
        ])->find($admission->academic_data_id);

        $level = $academicData->level;

        if ($level->type == 2) {
            $data['groupDepartment'] = $level->department->name;
            $data['year'] = $level->year->name;
        } elseif ($level->type == 1) {
            $data['groupDepartment'] = $level->group->name;
            $data['section'] = $level->groupSection->name;
        } else {
            $data['section'] = $level->section->name;
        }

        $data['session'] = $academicData->session->duration;
        $data['class'] = $academicData->class->name;
        $data['class_type'] = $academicData->class->type;

        return $data;

    }

    public function loadAcademicGroupList() {
        return Cache::remember('groupList', Carbon::parse()->addDays(7), function () {
            return AcademicGroup::whereNotIn('id', [14])->whereStatus(1)->select(['id', 'name as text'])->get();
        });
    }

    public function loadAcademicGroupAllList() {
        return Cache::remember('allGroupList', Carbon::parse()->addDays(7), function () {
            return AcademicGroup::whereStatus(1)->select(['id', 'name as text'])->get();
        });
    }

    public function loadAcademicDepartmentList() {
        return Cache::remember('departmentList', Carbon::parse()->addDays(7), function () {
            return AcademicDepartment::whereStatus(1)->select(['id', 'name as text'])->get();
        });
    }

    public function loadAcademicYearList() {
        return Cache::remember('yearList', Carbon::parse()->addDays(7), function () {
            return AcademicYear::whereStatus(1)->select(['id', 'name as text'])->get();
        });
    }

    public function loadAcademicSectionList() {
        return Cache::remember('sectionList', now()->addDays(7), function () {
            return AcademicSection::whereStatus(1)->select(['id', 'name as text'])->get();
        });
    }

    public function loadSalaryScaleList() {
        return SalaryScale::whereStatus(1)->select(['id', DB::raw('CONCAT(title," (",amount,")") AS text')])->get();
    }

    public function loadDesignationList() {
        return Cache::rememberForever('designation', function () {
            return Designation::whereStatus(1)->select(['id', 'title as text'])->get();
        });

    }

    public function loadBillForStudent() {
        return Cache::rememberForever('billItem', function () {
            return BillItem::select(['id', 'title as text', 'default_amount as amount'])->where('item_for', 'Students')->whereActivated(1)->get();
        });
    }

    /**
     * @param Request $request
     */
    public function loadStudentForClass(Request $request) {
        if ($request->has('class_id')) {
            $session = AcademicSession::whereIscurrent(1)->first();
            $students = AcademicData::whereAcademicSessionId($session->id)
                ->whereAcademicClassId($request->get("class_id"))
                ->pluck('user_id')
                ->toArray();

            return User::whereIn('id', $students)
                ->select(['id', DB::raw('CONCAT("(",custom,") ",name) AS text')])
                ->get();
        }
    }

    /**
     * @param Request $request
     */
    public function loadStudentForClassGroup(Request $request) {
        if ($request->has('class_id') && $request->has('group_id')) {
            $session = AcademicSession::whereIscurrent(1)->first();

            $levelIds = AcademicLevel::whereAcademicClassId(request('class_id'))->whereLevelOneId(request('group_id'))->pluck('id')->toArray();

            $students = AcademicData::whereAcademicSessionId($session->id)
                ->whereIn('academic_level_id', $levelIds)
                ->pluck('user_id')
                ->toArray();

            return User::whereIn('id', $students)
                ->select(['id', DB::raw('CONCAT("(",custom,") ",name) AS text')])
                ->get();
        }
    }

    /**
     * @param Request $request
     */
    public function loadStudentForClassDepartmentYear(Request $request) {
        if ($request->has('class_id') && $request->has('department_id') && $request->has('year_id')) {
            $session = AcademicSession::whereIscurrent(1)->first();
            $levelIds = AcademicLevel::whereAcademicClassId(request('class_id'))
                ->whereLevelOneId(request('department_id'))
                ->whereLevelTwoId(request('year_id'))
                ->pluck('id')->toArray();
            $students = AcademicData::whereAcademicSessionId($session->id)
                ->whereIn('academic_level_id', $levelIds)
                ->pluck('user_id')
                ->toArray();

            return User::whereIn('id', $students)
                ->select(['id', DB::raw('CONCAT("(",custom,") ",name) AS text')])
                ->get();
        }
    }

    /**
     * @param Request $request
     */
    public function loadSpecificStudent(Request $request) {
        if ($request->has('academic_class_id')) {
            $session = AcademicSession::whereIscurrent(1)->first();

            $level = AcademicLevel::query();
            $level = $level->whereAcademicClassId(request('academic_class_id'));
            if ($request->input("academic_class_type") == 2) {
                $level = $level->whereLevelOneId(request('academic_department_id'))
                    ->whereLevelTwoId(request('academic_year_id'));
            } elseif ($request->input("academic_class_type") == 1) {
                $level = $level->whereLevelOneId(request('academic_group_id'))
                    ->whereLevelTwoId(request('academic_section_id'));
            } else {
                $level = $level->whereLevelOneId(request('academic_section_id'));
            }

            $levelId = $level->first();

            if ($levelId) {
                $data = AcademicData::query();
                $data = $data->where('academic_session_id', $session->id)->whereAcademicLevelId($levelId->id)->pluck('user_id')->toArray();
                $students = User::whereIn('id', $data)->select(['id', DB::raw('CONCAT("(",custom,") ",name) AS text')])->get();
                return response()->json($students, 200);
            } else {
                return;
            }
        }
    }

    public function loadOfficeBillItes() {
        return BillItem::whereActivated(1)->whereItemFor('Office')->select(['id', 'title as text', 'default_amount'])->get();
    }

    public function loadSalaryScale() {
        return SalaryScale::whereStatus(true)->select(['id', 'title as text'])->get();
    }

    public function loadRoleList() {
        return Role::select(['id', 'name as text'])->get();
    }

    public function loadAccountList() {
        return Account::where('isActive', true)->select(['id', 'name as text', 'isActive'])->get();
    }

    public function loadTeacherList() {
        return User::role('Teacher')->select(['id', DB::raw('CONCAT("(",custom,") ",name) AS text')])->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function loadClassAllDetails($id) {
        return AcademicClass::select(['id', 'name', 'type'])->with([
            'sections:id,name as text',
            'academicGroups:id,name as text',
            'academicGroups.sections:id,name as text',

            'academicDepartments:id,name as text',
            'academicDepartments.sections:id,name as text',
        ])->findOrFail($id);
    }

    public function loadDayList() {
        return Cache::rememberForever('days', function () {
            return Day::select(['id', 'name as text', 'name_bn as text_bn'])->get();
        });
    }

    public function loadPeriodList() {
        return Cache::rememberForever('periods', function () {
            return ClassPeriod::select(['id', DB::raw('CONCAT("(",start," - ",end,") ",title) AS text')])->get();
        });
    }

    public function loadAcademicClassList() {
        return AcademicClass::whereStatus(1)->select(['id', 'name as text', 'status'])->get();
    }

    /**
     * @param $id
     */
    public function loadOnlyClassSectionGroupDepartment($id) {
        return AcademicClass::select(['id', 'type'])->with([
            'sections:id,name as text',
            'academicGroups:id,name as text',
            'academicDepartments:id,name as text',
        ])->findOrFail($id);
    }

    /**
     * @param Request $request
     */
    public function loadOnlyDepartmentYear(Request $request) {
        return AcademicDepartment::select(['id'])->with('sections:id,name as text')->findOrFail($request->input("id"));
    }

    /**
     * @param Request $request
     */
    public function loadClassStudentList(Request $request) {
        $request->validate([
            'session_id'          => 'required',
            'academic_class_id'   => 'required',
            'academic_class_type' => 'required',
            'level_one_id'        => 'required',
            'level_two_id'        => 'required_unless:academic_class_type,0',
        ]);

        $level = AcademicLevel::whereAcademicClassId(request('academic_class_id'))
            ->whereLevelOneId(request('level_one_id'))
            ->whereLevelTwoId(request('level_two_id'))
            ->first();

        $data['session'] = AcademicSession::find(request('session_id'));
        $data['academic_info'] = $level->details;

        $students = AcademicData::query();
        $students = $students->with([
            'user:id,name,photo,phone',
            'user.guardian.guardian:id,name,photo,phone',
        ])->whereAcademicSessionId($request->input("session_id"))
            ->whereAcademicClassId(request('academic_class_id'))
            ->whereAcademicLevelId($level->id)
            ->get();

        $data['students'] = $students;

        return response()->json($data, 200);
    }

}
