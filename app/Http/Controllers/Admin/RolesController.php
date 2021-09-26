<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create(['guard_name' => 'admin','name' => $request->name]);
        return redirect()->route('admin.roles.index')->with('success', 'Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($request->edit_id);
        $role->name = $request->name;
        $role->save();
        return redirect()->route('admin.roles.index')->with('success', 'Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Successfully Deleted.');
    }


    //assign permission to a role
    public function assignPermission()
    {
        $roles=Role::all();
        $permissions=Permission::all();
        return view('admin.roles.assignPermission',compact('roles','permissions'));
    }

    public function storePermissionToRole(Request $request)
    {
        $role=Role::find($request->role);


        foreach ($request->permission_ids as $permission_id) {
            $permission=Permission::find($permission_id);
            $role->givePermissionTo($permission);
            $permission->assignRole($role);
        }

        return redirect("rt-admin/assignPermission")->with("success","Permissions Assigned to Role.");

    }


    public function assignRole()
    {
        $admins=Admin::all();
        $roles=Role::all();
        return view("admin.roles.assignRole",compact('admins','roles'));
    }

    public function storeRoleToAdmin(Request $request)
    {
        $admin=Admin::find($request->admin_id);
        $role=Role::find($request->role_id);

        $admin->assignRole($role->name);

        return redirect("rt-admin/assignRole")->with("success","Role Assigned to Admin Successfully.");

    }
}
