<?php

namespace App\Actions;

use App\Enums\PlatformTransactionTypeEnum;
use App\Models\PlatformTransaction;

class PlatformTransactionAction
{
    public function credit($organizer_id = null, $user_id = null, $amount, $source, $description)
    {
        PlatformTransaction::create([
            'type' => PlatformTransactionTypeEnum::CREDIT,
            'organizer_id' => $organizer_id,
            'source' => $source,
            'amount' => $amount,
            'user_id' => $user_id
        ]);
    }
}
