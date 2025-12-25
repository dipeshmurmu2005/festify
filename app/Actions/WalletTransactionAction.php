<?php

namespace App\Actions;

use App\Enums\WalletTransactionTypeEnum;
use App\Models\Wallet;

class WalletTransactionAction
{
    public function credit($organizer_id, $amount, $notes)
    {
        $wallet = Wallet::where('organizer_id', $organizer_id)->first();
        if ($wallet) {
            $wallet->transactions()->create([
                'organizer_id' => $organizer_id,
                'type' => WalletTransactionTypeEnum::Credit,
                'amount' => $amount,
                'description' => $notes
            ]);
        }
    }
}
