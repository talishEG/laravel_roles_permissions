<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionsCreateRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view permissions' , only: ['index']),
            new Middleware('permission:edit permissions' , only: ['edit']),
            new Middleware('permission:create permissions' , only: ['create']),
            new Middleware('permission:delete permissions' , only: ['delete']),
        ];
    }
    public function index() {
        $permissions = Permission::latest()->paginate(8);
        return view('permissions.index', compact('permissions'));
    }

    public function create() {
        return view('permissions.create');
    }

    public function store(PermissionsCreateRequest $request) {
        $name = $request->input('name');
        $permission = Permission::create(['name' => $name]);
        if ($permission) {
            return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
        } else {
            return redirect()->route('permissions.index')->withInput()->with('error', 'Permission not created');
        }
    }

    public function edit($id) {
        $permission = Permission::findById($id);
        return view('permissions.create', compact('permission'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $permission = Permission::findOrFail($id);
        $permission->name = $request->input('name');
        if ($permission->isDirty('name')) {
            $permission->save();
            return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
        }
        return redirect()->route('permissions.index')->with('info', 'No changes were made to the permission.');
    }

    public function destroy($id) {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
    }
}
