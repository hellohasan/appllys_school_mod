<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller {

    public function __construct() {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Role::all();
    }

    public function roleSelect()
    {
        return Role::select(['id','name as text'])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:roles',
        ]);
        $in = $request->all();

        $role = Role::create($in);
        $role->syncPermissions($request->input('permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)->pluck('permission_id')->toArray();
        return response()->json(['permissions'=>$rolePermissions],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $role = Role::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
        ]);

        $role->update($request->all());
        $role->syncPermissions($request->input('permissions'));
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    }

    public function guard(){
        return Auth::guard('api');
    }
}
