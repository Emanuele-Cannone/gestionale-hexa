<?php

namespace App\Services;

use App\Models\Notification;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Summary of create
     */
    public function create(object $notify): void
    {

        try {

            DB::beginTransaction();

            Notification::create([
                'user_id' => $notify->user_id,
                'question_id' => $notify->question_id,
                'proof_id' => $notify->proof_id,
                'users_to' => json_encode($notify->notificationSendTo),
            ]);

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('richiesta fallita', [$e->getMessage()]);

        }

    }
}
