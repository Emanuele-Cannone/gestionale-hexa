<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleService
{
    /**
     * Summary of create
     */
    public function create(object $role): void
    {

        try {

            DB::beginTransaction();

            Role::create([
                'name' => $role->name,
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
