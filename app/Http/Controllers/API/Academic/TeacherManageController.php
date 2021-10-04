<?php

namespace App\Http\Controllers\API\Academic;

use App\User;
use App\Models\Teacher;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class TeacherManageController extends Controller {
    public function __construct() {
        $this->middleware(['role:Super Admin|Admin|Register']);
    }

    /**
     * @param Request $request
     */
    public function storeTeacher(Request $request) {
        $request->validate([
            'name'              => 'required',
            'email'             => 'required|email|unique:users,email',
            'code'              => 'required|unique:teachers,code',
            'phone'             => 'required|numeric|unique:users,phone',
            'password'          => 'required|confirmed|min:6',
            'join_date'         => 'required|date',
            'designation_id'    => 'required',
            'salary_scale_id'   => 'required',
            'type'              => 'required',
            'type_id'           => 'required',
            'religion_id'       => 'required',
            'blood'             => 'required',
            'educations'        => 'required|array',
            'educations.name.*' => 'required',
            'photo'             => 'sometimes|base64mimes:jpg,jpeg,png|base64max:200',
        ]);

        try {
            DB::beginTransaction();

            $in['name'] = $request->input("name");
            $in['email'] = $request->input("email");
            $in['phone'] = $request->input("phone");
            $in['password'] = bcrypt($request->input('password'));
            if ($request->image) {
                $name = time() . '_teacher.' . AppHelper::getFileExtension($request->image);
                $path = "storage/images/teachers/" . $name;
                Image::make($request->image)->resize(120, 150)->save(public_path($path));
                $in['photo'] = $path;
            }
            $user = User::create($in);

            $custom = date('y') . $this->customPad($request->input("type"), 1) . $this->customPad($request->input("type_id"), 2) . $this->customPad($user->id, 4);
            $role = Role::findByName("Teacher");
            $user->assignRole($role);
            $user->custom = $custom;
            $user->save();

            $te['user_id'] = $user->id;
            $te['type'] = $request->input("type");
            if ($te['type']) {
                $te['academic_department_id'] = $request->input("type_id");
            } else {
                $te['academic_group_id'] = $request->input("type_id");
            }
            $te['code'] = $request->input("code");
            $te['blood'] = $request->input("blood");
            $te['salary_scale_id'] = $request->input("salary_scale_id");
            $te['religion_id'] = $request->input('religion_id');
            $te['join_date'] = $request->input("join_date");
            $te['designation_id'] = $request->input('designation_id');
            $teacher = Teacher::create($te);

            $user->salary()->updateOrCreate(['user_id' => $user->id], [
                'salary_scale_id' => $request->input("salary_scale_id"),
            ]);

            foreach ($request->input('educations') as $edu) {
                $teacher->educations()->create([
                    'name' => $edu['name'],
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 503);
        }
    }

    /**
     * @param $start
     * @param $length
     */
    public function customPad($start, $length) {
        return (str_pad((int) $start, $length, '0', STR_PAD_LEFT));
    }

    public function getTeacher() {
        return User::role("Teacher")
            ->with([
                'teacher',
                'teacher.academicDepartment',
                'teacher.academicGroup',
                'teacher.salaryScale',
                'teacher.designation',
            ])
            ->get();
    }

    /**
     * @param $custom
     */
    public function editTeacher($custom) {
        return User::whereCustom($custom)
            ->with([
                'teacher',
                'teacher.educations',
            ])
            ->firstOrFail();
    }

    /**
     * @param Request $request
     * @param $custom
     */
    public function updateTeacher(Request $request, $custom) {
        $user = User::whereCustom($custom)->firstOrFail();
        $teacher = Teacher::whereUserId($user->id)->firstOrFail();

        $request->validate([
            'name'              => 'required',
            'email'             => 'required|email|unique:users,email,' . $user->id,
            'phone'             => 'required|numeric|unique:users,phone,' . $user->id,
            'code'              => 'required|unique:teachers,code,' . $teacher->id,
            'password'          => 'sometimes|confirmed|min:6|alpha_num',
            'join_date'         => 'required|date',
            'designation_id'    => 'required',
            'salary_scale_id'   => 'required',
            'type'              => 'required',
            'type_id'           => 'required',
            'religion_id'       => 'required',
            'blood'             => 'required',
            'educations'        => 'required|array',
            'educations.name.*' => 'required',
            'photo'             => 'sometimes|base64mimes:jpg,jpeg,png|base64max:200',
        ]);

        try {
            DB::beginTransaction();

            $in['name'] = $request->input("name");
            $in['email'] = $request->input("email");
            $in['phone'] = $request->input("phone");

            if ($request->input('password')) {
                $in['password'] = bcrypt($request->input('password'));
            }
            if ($request->image) {
                $name = time() . '_teacher.' . AppHelper::getFileExtension($request->image);
                $path = "storage/images/teachers" . '/' . $name;
                Image::make($request->image)->resize(120, 150)
                    ->save(public_path($path));
                $in['photo'] = $path;
            }
            $user->update($in);

            $custom = date('y') . $this->customPad($request->input("type"), 1) . $this->customPad($request->input("type_id"), 2) . $this->customPad($user->id, 4);
            $user->custom = $custom;
            $user->save();

            $te['user_id'] = $user->id;
            $te['type'] = $request->input("type");
            if ($te['type']) {
                $te['academic_department_id'] = $request->input("type_id");
                $te['academic_group_id'] = null;
            } else {
                $te['academic_group_id'] = $request->input("type_id");
                $te['academic_department_id'] = null;
            }

            $te['code'] = $request->input("code");
            $te['blood'] = $request->input("blood");
            $te['salary_scale_id'] = $request->input("salary_scale_id");
            $te['religion_id'] = $request->input('religion_id');
            $te['join_date'] = $request->input("join_date");
            $te['designation_id'] = $request->input('designation_id');
            $teacher->update($te);
            $teacher->educations()->delete();

            $user->salary()->updateOrCreate(['user_id' => $user->id], [
                'salary_scale_id' => $request->input("salary_scale_id"),
            ]);

            foreach ($request->input('educations') as $edu) {
                $teacher->educations()->create([
                    'name' => $edu['name'],
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }

    }

}
