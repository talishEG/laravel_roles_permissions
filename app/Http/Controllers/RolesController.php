<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RolesController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view roles' , only: ['index']),
            new Middleware('permission:edit roles' , only: ['edit']),
            new Middleware('permission:create roles' , only: ['create']),
            new Middleware('permission:delete roles' , only: ['delete']),
        ];
    }
    public function index() {
        $roles = Role::where('name', '!=', 'Super Admin')->latest()->paginate(5);
        return view('roles.index', compact('roles'));
    }

    public function create() {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('roles.create',[
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:3',
        ]);
        if($validator->passes()) {
            $role = Role::create(['name' => $request->name]);
            if (!empty($request->permissions)) {
                foreach ($request->permissions as $name) {
                    $role->givePermissionTo($name);
                }
            }
            return redirect()->route('roles.index')->with('success', 'Role created successfully');
        } else {
            return back()->withErrors($validator)->withInput()->withErrors($validator);
        }
    }

    public function edit($id) {
        $role = Role::find($id);
        $hasPermissions = null;
        if ($role) {
            $hasPermissions = $role->permissions->pluck('name');
        }
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('roles.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'hasPermissions' => $hasPermissions
        ]);
    }

    public function update(Request $request, $id) {
        $role = Role::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,'.$id.',id|min:3',
        ]);
        if($validator->passes()) {
            $role->name = $request->input('name');
            $role->save();
            if (!empty($request->permissions)) {
                $role->syncPermissions($request->permissions);
            } else {
                $role->syncPermissions([]);
            }
            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        } else {
            return back()->withErrors($validator)->withInput()->withErrors($validator);
        }
    }

    public function destroy($id) {
        $role = Role::find($id);
        if ($role == null) {
            return redirect()->route('roles.index')->with('error', 'Role not found');
        }
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}
