<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionStoreRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Models\User;
use App\Services\PermissionService;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public PermissionService $permissionService;

    public function __construct()
    {
        $this->permissionService = new PermissionService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all()->sortBy('section');

        return view('permissions.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionStoreRequest $permissionStoreRequest)
    {
        $this->permissionService->create($permissionStoreRequest);

        return Redirect::route('permissions.index');

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionUpdateRequest $permissionUpdateRequest)
    {

        $this->permissionService->update($permissionUpdateRequest);

        return Redirect::route('user-role');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->permissionService->destroy($id);

        return Redirect::route('permissions.index');
    }


    /**
     * Summary of getUserPermission
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getUserPermission(string $id)
    {
        $user = User::findOrFail($id);

        $attributeExists = $user->permissions->pluck('id')->toArray();

        $attributeRoleExists = $user->getPermissionsViaRoles()->pluck('id')->toArray();

        foreach ($attributeRoleExists as $key => $attribute) {

            $attributeExists[] = $attribute;
        }

        $permissions = [];

        $permissionsKey = Permission::all()->keyBy('section');

        foreach ($permissionsKey as $permissionKey) {

            $permissions[$permissionKey->section] = Permission::where('section', $permissionKey->section)->get();
        }

        return view('permissions.permission-user',
            [
                'user' => $user,
                'permissions' => $permissions,
                'attributeExists' => $attributeExists
            ]
        );
    }
}
