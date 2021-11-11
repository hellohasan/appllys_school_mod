<?php

namespace App\Http\Controllers\API;

use App\User;
use DataTables;
use App\Models\Student;
use App\Models\Admission;
use App\Helpers\AppHelper;
use App\Models\ParentUser;
use App\Models\UserParent;
use App\Models\UserAddress;
use App\Models\AcademicData;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use App\Models\AcademicClass;
use App\Models\UserFamilyInfo;
use App\Models\AcademicSession;
use App\Models\AcademicSubject;
use App\Models\UserInformation;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\UserPreviousInstitute;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;

class AdmissionController extends Controller {

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
     * @param $classId
     * @param $type
     * @param $groupDepartment
     * @return mixed
     */
    public function findSerial($classId, $type, $groupDepartment) {
        $cls = AcademicClass::select(['id'])
            ->with([
                'academicGroups:id',
                'academicDepartments:id'])
            ->findOrFail($classId);
        $lists = [];
        if ($type === 1) {
            $lists = json_decode(json_encode($cls->academicGroups), true);
        }
        if ($type === 2) {
            $lists = json_decode(json_encode($cls->academicDepartments), true);
        }
        $key = array_search($groupDepartment, array_column($lists, 'id'), true);
        $keyT = $key + 1;

        return $keyT;
    }

    /**
     * @param $sessionId
     * @param $classId
     * @param $type
     * @param $groupDepartment
     * @return mixed
     */
    public function createAcademicId($sessionId, $classId, $type, $groupDepartment, $other = null) {
        $sessionCode = AcademicSession::findOrFail($sessionId)->code;

        if ($type == 1) {
            $serial = AcademicData::whereAcademicSessionId($sessionId)
                ->whereAcademicClassId($classId)
                ->whereAcademicGroupId($groupDepartment)
                ->whereAcademicSectionId($other)
                ->orderBy('id', 'desc')
                ->first();
            if ($serial) {
                return $serial->custom + 1;
            }

            return $sessionCode . $this->customPad($classId, null, 2) . $this->customPad($groupDepartment, null, 2) . $this->customPad($other, null, 1) . $this->customPad(1, null, 3);
        } elseif ($type == 2) {
            $serial = AcademicData::whereAcademicSessionId($sessionId)
                ->whereAcademicClassId($classId)
                ->whereAcademicDepartmentId($groupDepartment)
                ->whereAcademicYearId($other)
                ->first();
            if ($serial) {
                return $serial->custom + 1;
            }

            return $sessionCode . $this->customPad($classId, null, 2) . $this->customPad($groupDepartment, null, 2) . $this->customPad($other, null, 1) . $this->customPad(1, null, 3);
        } else {
            $serial = AcademicData::whereAcademicSessionId($sessionId)
                ->whereAcademicClassId($classId)
                ->whereAcademicSectionId($groupDepartment)
                ->first();
            if ($serial) {
                return $serial->custom + 1;
            }

            return $sessionCode . $this->customPad($classId, null, 2) . $this->customPad($groupDepartment, null, 3) . $this->customPad(1, null, 3);
        }
    }

    /**
     * @param Request $request
     */
    public function submitAdmissionForm(Request $request) {
        $request->validate([
            'session_id'                => 'required',
            'academic_class_id'         => 'required',
            'type'                      => 'required',
            'academic_section_id'       => 'required_if:type,0',
            'academic_group_id'         => 'required_if:type,1',
            'academic_group_section_id' => 'required_if:type,1',
            'academic_department_id'    => 'required_if:type,2',
            'academic_year_id'          => 'required_if:type,2',
            'optional_subject_id'       => 'nullable|numeric',
            'name'                      => 'required|max:191',
            'name_bn'                   => 'required|max:191',
            'nid'                       => 'required|max:50',
            'dob'                       => 'required|date',
            'language'                  => 'required|max:50',
            'nationality'               => 'required|max:50',
            'gender'                    => 'required|max:50',
            'religion_id'               => 'required|max:50',
            'blood'                     => 'required|max:50',
            'phone'                     => 'nullable|max:50',
            'email'                     => 'nullable|email|max:50',

            'division_id'               => 'required',
            'district_id'               => 'required',
            'upazila_id'                => 'required',
            'union_name'                => 'required|max:191',
            'post_office'               => 'required|max:191',
            'village'                   => 'required|max:191',
            'present_division_id'       => 'required_if:address_type,0',
            'present_district_id'       => 'required_if:address_type,0',
            'present_upazila_id'        => 'required_if:address_type,0',
            'present_union_name'        => 'required_if:address_type,0|max:191',
            'present_post_office'       => 'required_if:address_type,0|max:191',
            'present_village'           => 'required_if:address_type,0|max:191',

            'guardian_type'             => 'required',
            'guardian_id'               => 'required_if:guardian_type,1',
            'father_name'               => 'required|max:191',
            'father_name_bn'            => 'required|max:191',
            'father_nid'                => 'required|max:191',
            'father_occupation'         => 'required|max:191',
            'father_phone'              => 'required|max:191',
            'father_email'              => 'nullable|email|max:191',
            'mother_name'               => 'required|max:191',
            'mother_name_bn'            => 'required|max:191',
            'mother_nid'                => 'required|max:191',
            'mother_occupation'         => 'required|max:191',
            'mother_phone'              => 'required|max:191',
            'mother_email'              => 'nullable|email|max:191',
            'guardian_choice'           => 'required_if:guardian_type,0',

            'guardian_name'             => 'required_if:guardian_choice,2|max:191',
            'guardian_name_bn'          => 'required_if:guardian_choice,2|max:191',
            'guardian_nid'              => 'required_if:guardian_choice,2|max:191',
            'guardian_relation'         => 'required_if:guardian_choice,2|max:191',
            'guardian_occupation'       => 'required_if:guardian_choice,2|max:191',
            'guardian_phone'            => 'required_if:guardian_choice,2|max:191',
            'guardian_email'            => 'nullable|email|max:191',

            'family_total_member'       => 'required|nullable|numeric|max:191',
            'family_earnable'           => 'required|nullable|numeric',
            'yearly_earn'               => 'required|nullable|numeric',

            'image'                     => 'required|base64max:52',
            'guardian_image'            => 'required_if:guardian_choice,2|base64max:52',
            'father_image'              => 'required|base64max:52',
            'mother_image'              => 'required|base64max:52',
            'student_nid_image'         => 'required|base64max:2000',
            'guardian_nid_image'        => 'required|base64max:2000',
            'mother_nid_image'          => 'required|base64max:2000',
            'documents'                 => 'nullable|array',
            'documents.type_id*'        => 'required',
            'documents.file*'           => 'required|base64max:2000',
            'previous_academic'         => 'required',
            'old_institute_name'        => 'required_if:previous_academic,1|max:191',
            'old_institute_address'     => 'required_if:previous_academic,1|max:191',
            'old_institute_class'       => 'required_if:previous_academic,1|max:191',
            'old_institute_roll'        => 'required_if:previous_academic,1|max:191',
            'old_institute_group'       => 'nullable|max:191',
            'admission_fee'             => 'numeric',
            'checkUp'                   => 'accepted',
        ]);

        try {
            DB::beginTransaction();
            /* Start
             * Student creation
             * */
            $us['name'] = $request->input("name");
            $us['email'] = $request->input("email");
            $us['phone'] = $request->input("phone");
            $us['password'] = bcrypt('12345678');
            $user = User::create($us);

            File::makeDirectory(public_path("storage/images/users/$user->id"), $mode = 0777, true, true);

            if ($request->image) {
                $name = time() . '_profile.' . AppHelper::getFileExtension($request->image);
                $path = "storage/images/users/$user->id" . '/' . $name;
                Image::make($request->image)->resize(120, 150)->save(public_path($path));
                $user->photo = $path;
            }
            $studentRole = Role::findByName('Student');
            $user->assignRole([$studentRole->id]);

            /* End
             * Student creation
             * */

            $academic['user_id'] = $user->id;
            $academic['academic_session_id'] = $request->input("session_id");
            $academic['academic_class_id'] = $request->input("academic_class_id");
            $academic['type'] = $request->input("type");

            if ($request->input("type") === 0) {
                $academic['custom'] = $this->createAcademicId($request->input("session_id"), $request->input("academic_class_id"), $request->input("type"), $request->input("academic_section_id"));
                $academic['academic_section_id'] = $request->input("academic_section_id");
            } elseif ($request->input("type") === 1) {
                $academic['custom'] = $this->createAcademicId($request->input("session_id"), $request->input("academic_class_id"), $request->input("type"), $request->input("academic_group_id"), $request->input("academic_group_section_id"));
                $academic['academic_group_id'] = $request->input("academic_group_id");
                $academic['academic_section_id'] = $request->input("academic_group_section_id");
            } else {
                $academic['custom'] = $this->createAcademicId($request->input("session_id"), $request->input("academic_class_id"), $request->input("type"), $request->input("academic_department_id"), $request->input("academic_year_id"));
                $academic['academic_department_id'] = $request->input("academic_department_id");
                $academic['academic_year_id'] = $request->input("academic_year_id");
            }
            $academic = AcademicData::create($academic);
            $user->custom = $academic->custom;

            $info['user_id'] = $user->id;
            $info['name_bn'] = $request->input("name_bn");
            $info['nid'] = $request->input("nid");
            $info['dob'] = $request->input("dob");
            $info['language'] = $request->input("language");
            $info['nationality'] = $request->input("nationality");
            $info['gender'] = $request->input("gender");
            $info['religion_id'] = $request->input("religion_id");
            $info['blood'] = $request->input("blood");

            UserInformation::create($info);

            $add['user_id'] = $user->id;
            $add['division_id'] = $request->input("division_id");
            $add['district_id'] = $request->input("district_id");
            $add['upazila_id'] = $request->input("upazila_id");
            $add['union_name'] = $request->input("union_name");
            $add['post_office'] = $request->input("post_office");
            $add['village'] = $request->input("village");
            $add['address_type'] = $request->input("address_type");
            if (!$request->input("address_type")) {
                $add['present_division_id'] = $request->input("present_division_id");
                $add['present_district_id'] = $request->input("present_district_id");
                $add['present_upazila_id'] = $request->input("present_upazila_id");
                $add['present_union_name'] = $request->input("present_union_name");
                $add['present_post_office'] = $request->input("present_post_office");
                $add['present_village'] = $request->input("present_village");
            }
            UserAddress::create($add);

            /* Start
             * Student Father creation
             * */

            $pa['user_id'] = $user->id;
            $pa['relation'] = 'Father';
            $pa['name'] = $request->input("father_name");
            $pa['name_bn'] = $request->input("father_name_bn");
            $pa['nid'] = $request->input("father_nid");
            $pa['occupation'] = $request->input("father_occupation");
            $pa['phone'] = $request->input("father_phone");
            $pa['email'] = $request->input("father_email");
            if ($request->father_image) {
                $name = time() . '_father.' . AppHelper::getFileExtension($request->father_image);
                $path = "storage/images/users/$user->id" . '/' . $name;
                Image::make($request->father_image)->resize(120, 150)
                    ->save(public_path($path));
                $pa['image'] = $path;
            }
            $father = UserParent::create($pa);

            /* Start
             * Student mother creation
             * */
            $ma['user_id'] = $user->id;
            $ma['relation'] = 'Mother';
            $ma['name'] = $request->input("mother_name");
            $ma['name_bn'] = $request->input("mother_name_bn");
            $ma['nid'] = $request->input("mother_nid");
            $ma['occupation'] = $request->input("mother_occupation");
            $ma['phone'] = $request->input("mother_phone");
            $ma['email'] = $request->input("mother_email");
            if ($request->mother_image) {
                $name = time() . '_mother.' . AppHelper::getFileExtension($request->mother_image);
                $path = "storage/images/users/$user->id" . '/' . $name;
                Image::make($request->mother_image)->resize(120, 150)
                    ->save(public_path($path));
                $ma['image'] = $path;
            }
            $mother = UserParent::create($ma);

            /* Start
             * Student Guardian creation
             * */

            if ($request->input("guardian_type")) {
                $g = ParentUser::whereParentId($request->input("guardian_id"))->first();
                $user->guardian()->create([
                    'parent_id' => $request->input("guardian_id"),
                    'info_id'   => $g->info_id,
                ]);
            } else {
                if ($request->input("guardian_choice") == 0) {
                    $fat['name'] = $request->input("father_name");
                    $fat['email'] = $request->input("father_email");
                    $fat['phone'] = $request->input("father_phone");
                    $fat['password'] = bcrypt('12345678');
                    $guardian = User::create($fat);
                    $guardianRole = Role::findByName('Guardian');
                    $guardian->assignRole([$guardianRole->id]);

                    $user->guardian()->create([
                        'parent_id' => $guardian->id,
                        'info_id'   => $father->id,
                    ]);
                } elseif ($request->input("guardian_choice") == 1) {
                    $mot['name'] = $request->input("mother_name");
                    $mot['email'] = $request->input("mother_email");
                    $mot['phone'] = $request->input("mother_phone");
                    $mot['password'] = bcrypt('12345678');
                    $guardian = User::create($mot);
                    $guardianRole = Role::findByName('Guardian');
                    $guardian->assignRole([$guardianRole->id]);

                    $user->guardian()->create([
                        'parent_id' => $guardian->id,
                        'info_id'   => $mother->id,
                    ]);
                } else {
                    $gua['user_id'] = $user->id;
                    $gua['relation'] = $request->input("guardian_relation");
                    $gua['name'] = $request->input("guardian_name");
                    $gua['name_bn'] = $request->input("guardian_name_bn");
                    $gua['nid'] = $request->input("guardian_nid");
                    $gua['occupation'] = $request->input("guardian_occupation");
                    $gua['phone'] = $request->input("guardian_phone");
                    $gua['email'] = $request->input("guardian_email");

                    if ($request->guardian_image) {
                        $name = time() . '_guardian.' . AppHelper::getFileExtension($request->guardian_image);
                        $path = "storage/images/users/$user->id" . '/' . $name;
                        Image::make($request->guardian_image)->resize(120, 150)
                            ->save(public_path($path));
                        $gua['image'] = $path;
                    }
                    $guu = UserParent::create($gua);

                    $gu['name'] = $request->input("guardian_name");
                    $gu['email'] = $request->input("guardian_email");
                    $gu['phone'] = $request->input("guardian_phone");
                    $gu['photo'] = $guu->image;
                    $gu['password'] = bcrypt('12345678');
                    $guardian = User::create($gu);
                    $guardianRole = Role::findByName('Guardian');
                    $guardian->assignRole([$guardianRole->id]);
                    $user->guardian()->create([
                        'parent_id' => $guardian->id,
                        'info_id'   => $guu->id,
                    ]);
                }

            }

            $family['user_id'] = $user->id;
            $family['total_member'] = $request->input("family_total_member");
            $family['earnable_member'] = $request->input("family_earnable");
            $family['yearly_earn'] = $request->input("yearly_earn");
            UserFamilyInfo::create($family);

            $doc['user_id'] = $user->id;

            if ($request->student_nid_image) {
                $name = time() . '_student_nid.' . AppHelper::getFileExtension($request->student_nid_image);
                $path = "storage/images/users/$user->id" . '/' . $name;
                Image::make($request->student_nid_image)
                    ->save(public_path($path));
                $doc['path'] = $path;
                $doc['type'] = 'Student NID';
                UserDocument::create($doc);
            }

            if ($request->father_nid_image) {
                $name = time() . '_father_nid.' . AppHelper::getFileExtension($request->father_nid_image);
                $path = "storage/images/users/$user->id" . '/' . $name;
                Image::make($request->father_nid_image)
                    ->save(public_path($path));
                $doc['path'] = $path;
                $doc['type'] = 'Father NID';
                UserDocument::create($doc);
            }

            if ($request->mother_nid_image) {
                $name = time() . '_mother_nid.' . AppHelper::getFileExtension($request->mother_nid_image);
                $path = "storage/images/users/$user->id" . '/' . $name;
                Image::make($request->mother_nid_image)
                    ->save(public_path($path));
                $doc['path'] = $path;
                $doc['type'] = 'Mother NID';
                UserDocument::create($doc);
            }

            if ($request->guardian_nid_image) {
                $name = time() . '_guardian_nid.' . AppHelper::getFileExtension($request->guardian_nid_image);
                $path = "storage/images/users/$user->id" . '/' . $name;
                Image::make($request->guardian_nid_image)
                    ->save(public_path($path));
                $doc['path'] = $path;
                $doc['type'] = 'Guardian NID';
                UserDocument::create($doc);
            }

            foreach ($request->input("documents") as $docu) {
                if ($docu['file'] && $docu['type']) {
                    $name = time() . '_' . $docu['type'] . '.' . AppHelper::getFileExtension($docu['file']);
                    $path = "storage/images/users/$user->id" . '/' . $name;
                    Image::make($docu['file'])
                        ->save(public_path($path));
                    $doc['path'] = $path;
                    $doc['type'] = $docu['type'];
                    UserDocument::create($doc);
                }
            }

            if ($request->input("previous_academic")) {
                $pi['user_id'] = $user->id;
                $pi['old_institute_name'] = $request->input("old_institute_name");
                $pi['old_institute_address'] = $request->input("old_institute_address");
                $pi['old_institute_class'] = $request->input("old_institute_class");
                $pi['old_institute_roll'] = $request->input("old_institute_roll");
                $pi['old_institute_group'] = $request->input("old_institute_group");
                UserPreviousInstitute::create($pi);
            }

            $ad['user_id'] = $user->id;
            $ad['academic_data_id'] = $academic->id;
            $ad['academic_session_id'] = $request->input("session_id");
            Admission::create($ad);

            $user->save();

            $subjects = [];
            $class = AcademicClass::findOrFail($request->input("academic_class_id"));
            if ($class->type == 2) {
                $compolsory = AcademicSubject::whereAcademicClassId($class->id)
                    ->where('religion_type', '!=', 1)
                    ->whereAcademicDepartmentId($request->input("academic_department_id"))
                    ->whereAcademicYearId($request->input("academic_year_id"))
                    ->pluck('id')
                    ->toArray();

                $religion = AcademicSubject::whereAcademicClassId($class->id)
                    ->whereAcademicDepartmentId($request->input("academic_department_id"))
                    ->whereAcademicYearId($request->input("academic_year_id"))
                    ->whereReligionId($request->input("religion_id"))
                    ->pluck('id')
                    ->toArray();

            } elseif ($class->type == 1) {
                $compolsory = AcademicSubject::whereAcademicClassId($class->id)
                    ->whereAcademicGroupId($request->input("academic_group_id"))
                    ->where('religion_type', '!=', 1)
                    ->pluck('id')
                    ->toArray();

                $religion = AcademicSubject::whereAcademicClassId($class->id)
                    ->whereAcademicGroupId($request->input("academic_group_id"))
                    ->whereReligionId($request->input("religion_id"))
                    ->pluck('id')
                    ->toArray();
            } else {
                $compolsory = AcademicSubject::whereAcademicClassId($class->id)
                    ->where('religion_type', '!=', 1)
                    ->pluck('id')
                    ->toArray();

                $religion = AcademicSubject::whereAcademicClassId($class->id)
                    ->whereReligionId($request->input("religion_id"))
                    ->pluck('id')
                    ->toArray();
            }
            $subjects = array_merge($compolsory, $religion);

            foreach ($subjects as $subject) {
                $sub['user_id'] = $user->id;
                $sub['academic_data_id'] = $academic->id;
                $sub['academic_subject_id'] = $subject;
                if ($subject == $request->input("optional_subject_id")) {
                    $sub['isOptional'] = true;
                } else {
                    $sub['isOptional'] = false;
                }
                $academic->subjects()->create($sub);
            }

            DB::commit();

            return Response::json($user->custom, 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response($e, 500);
            // something went wrong
        }
    }

    /**
     * @param Request $request
     */
    public function getAdmissionList(Request $request) {
        $request->validate([
            'session_id' => 'required',
        ]);

        return Admission::whereAcademicSessionId($request->input("session_id"))
            ->with([
                'user:id,name,custom,photo',
                'academic',
                'user.guardian.guardian:id,name'])
            ->get();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function loadAdmissionDetails(Request $request) {
        $request->validate([
            'custom' => 'required',
        ]);

        $academic = AcademicData::whereCustom($request->input("custom"))->first();

        return $academic;

    }

    /**
     * @param Request $request
     */
    public function testStudentDataTable(Request $request) {
        //return Student::latest()->get();
        $data = Student::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $id = $row->id;

                return "<button data-id='$id' data-action='delete' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i> Delete</button>";
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
