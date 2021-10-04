<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return User::with([
            'roles',
            'salary:id,user_id,salary_scale_id',
            'salary.salary_scale:id,title',
        ])->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name'     => 'required|max:191',
            'email'    => 'required|unique:users|max:191',
            'password' => 'required|min:6|max:191',
            'role'     => 'required',
        ]);

        $in = $request->except(['role']);
        $in['password'] = bcrypt($request->input('password'));
        $user = User::create($in);
        $role = Role::findById($request->role);
        $user->assignRole($role);

        if ($request->input('salary_scale_id')) {
            $user->salary()->updateOrCreate(['user_id' => $user->id], [
                'salary_scale_id' => $request->input("salary_scale_id"),
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|max:191',
            'email'    => 'required|max:191|unique:users,email,' . $id,
            'password' => 'sometimes|min:6|max:191',
            'role'     => 'required',
        ]);

        $in = $request->except(['role']);
        if ($request->input('password')) {
            $in['password'] = bcrypt($request->input('password'));
        }
        $role = Role::findById($request->role);
        $user->syncRoles($role);
        $user->update($in);

        if ($request->input('salary_scale_id')) {
            $user->salary()->updateOrCreate(['user_id' => $user->id], [
                'salary_scale_id' => $request->input("salary_scale_id"),
            ]);
        }else{
            $user->salary()->delete();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function profile() {
        return auth('api')->user();
    }

    /**
     * @param Request $request
     */
    public function updateProfile(Request $request) {
        $user = auth('api')->user();

        $request->validate([
            'name'  => 'required|max:191',
            'email' => 'required|max:191|unique:users,email,' . $user->id,
            'bio'   => 'required',
            'photo' => 'sometimes|base64mimes:jpg,jpeg,png|base64max:1024',
        ]);

        $in = $request->except(['photo']);
        if ($request->photo) {
            $ext = explode('/', substr($request->photo, 0, strpos($request->photo, ';')))[1];
            $name = time() . '.' . $ext;
            Image::make($request->photo)->resize(60, 60)->save(public_path('img/profile/') . $name);
            $in['photo'] = 'img/profile/' . $name;

            $defaultImage = "img/profile/profile.png";
            if ($user->photo !== $defaultImage) {
                File::delete(public_path($user->photo));
            }
        }
        $user->update($in);
    }

    /**
     * @param Request $request
     */
    public function updatePassword(Request $request) {
        $user = auth('api')->user();

        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|confirmed|min:6',
        ]);

        $c_password = $user->password;

        if (Hash::check($request->current_password, $c_password)) {
            $password = Hash::make($request->password);
            $user->password = $password;
            $user->save();

            return response()->json(['message' => 'Password Changes Successfully.'], 200);
        } else {
            return response()->json(['message' => 'Current Password Not Match'], 400);
        }
    }
}
