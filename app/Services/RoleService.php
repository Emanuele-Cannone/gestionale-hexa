<?php

namespace App\Services;

use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleService
{
    /**
     * Summary of create
     */
    public function create(RoleStoreRequest $roleStoreRequest): void
    {

        try {

            DB::beginTransaction();

            Role::create([
                'name' => $roleStoreRequest->name,
                'guard_name' => 'web',
            ]);

            smilify('success', __('attendance.success'));

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('richiesta fallita', [$e->getMessage()]);

        }

    }
    /**
     * Summary of update
     */
    public function update(RoleUpdateRequest $roleUpdateRequest, string $id): void
    {

        try {

            DB::beginTransaction();

            $role = Role::findOrFail($id);

            $role->syncPermissions($roleUpdateRequest->permissions);

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

            Role::destroy($id);

            smilify('success', __('attendance.success'));

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('richiesta fallita', [$e->getMessage()]);

        }

    }
}
