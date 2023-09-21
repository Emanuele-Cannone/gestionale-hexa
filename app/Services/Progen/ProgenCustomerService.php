<?php

namespace App\Services\Progen;

use App\Exceptions\Progen\ProgenCreateCustomerException;
use App\Http\Requests\Progen\ProgenCustomerStoreRequest;
use App\Models\Progen\ProgenCustomer;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProgenCustomerService
{
    public function create(ProgenCustomerStoreRequest $request): void
    {

        try {
            DB::beginTransaction();

            $data = $request->validated();

            ProgenCustomer::create($data);

            DB::commit();

            smilify('success', 'You are successfully reconnected');

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('creazione nuovo cliente fallita', [$e->getMessage()]);
            throw new ProgenCreateCustomerException();
        }
    }

    public function update(ProgenCustomerStoreRequest $request)
    {

    }
}
