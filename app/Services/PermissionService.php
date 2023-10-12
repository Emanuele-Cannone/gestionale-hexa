<?php

namespace App\Services;

use App\Http\Requests\PermissionUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class PermissionService
{
    /**
     * Summary of create
     */
    public function create(object $permission): void
    {

        try {

            DB::beginTransaction();

            Permission::create([
                'name' => $permission->name,
                'guard_name' => 'web',
                'section' => $permission->section
            ]);

            smilify('success', __('attendance.success'));

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('richiesta fallita', [$e->getMessage()]);

        }

    }

    /**
     * Summary of destroy
     */
    public function update(PermissionUpdateRequest $permissionUpdateRequest): void
    {

        try {

            DB::beginTransaction();

            $user = User::findOrFail($permissionUpdateRequest->user_id);

            $user->syncPermissions($permissionUpdateRequest->permissions);

            smilify('success', __('attendance.success'));

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('richiesta fallita', [$e->getMessage()]);

        }

    }

    /**
     * Summary of destroy
     */
    public function destroy(string $id): void
    {

        try {

            DB::beginTransaction();

            Permission::destroy($id);

            smilify('success', __('attendance.success'));

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('richiesta fallita', [$e->getMessage()]);

        }

    }
}
