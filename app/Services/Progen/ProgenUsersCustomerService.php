<?php

namespace App\Services\Progen;

use App\Exceptions\Progen\ProgenUsersCustomerException;
use App\Http\Requests\Progen\ProgenUserStoreRequest;
use App\Models\Progen\ProgenCustomer;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProgenUsersCustomerService
{
    public function update(ProgenUserStoreRequest $request, string $id): void
    {

        try {

            DB::beginTransaction();

            $data = $request->validated();

            $customer = ProgenCustomer::findOrFail($id);

            $customer->users()->attach($data['users'], ['leader' => 0, 'user_type' => $data['users_type']]);

            DB::commit();

            smilify('success', 'You are successfully reconnected');

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('assegnazione utente cliente fallita', [$e->getMessage()]);
            throw new ProgenUsersCustomerException();
        }
    }
}
