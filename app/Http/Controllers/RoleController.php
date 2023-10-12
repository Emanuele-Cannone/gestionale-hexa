<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\User;
use App\Services\RoleService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public $roleService;

    public function __construct()
    {
        $this->roleService = new RoleService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Auth::user()->hasPermissionTo('create role');

        $permissions = Permission::all();

        return view('roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $roleStoreRequest)
    {
        Auth::user()->hasPermissionTo('create role');

        $this->roleService->create($roleStoreRequest);

        return Redirect::route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {

//        Auth::user()->hasPermissionTo('assign permission role');

        $permissions = [];

        $permissionsKey = Permission::all()->keyBy('section');

        foreach ($permissionsKey as $permissionKey) {

            $permissions[$permissionKey->section] = Permission::where('section', $permissionKey->section)->get();
        }

        $attributeExists = $role->permissions->pluck('id')->toArray();

        return view('roles.edit',
            [
                'permissions' => $permissions,
                'role' => $role,
                'attributeExists' => $attributeExists
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $roleUpdateRequest, string $id)
    {

        $this->roleService->update($roleUpdateRequest, $id);

        return Redirect::route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Auth::user()->hasPermissionTo('delete role');

        $this->roleService->destroy($id);

        return Redirect::route('roles.index');

    }

    public function getUserRole()
    {
        $users = User::all();

        $roles = Role::all();

        return view('roles.role-user',
            [
                'users' => $users,
                'roles' => $roles
            ]
        );
    }

    public function roleMonitor()
    {
        $roles = Role::all();

        return view('roles.role-monitor',
            [
                'roles' => $roles
            ]
        );
    }
}
