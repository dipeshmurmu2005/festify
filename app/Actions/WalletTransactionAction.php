<?php

namespace App\Actions;

use App\Enums\WalletTransactionSourceAndDestinationTypeEnum;
use App\Enums\WalletTransactionTypeEnum;
use App\Models\Payment;
use App\Models\Wallet;
use Illuminate\Support\Str;

class WalletTransactionAction
{
    public function credit($organizer_id, $amount, $reference, $notes)
    {
        $wallet = Wallet::where('organizer_id', $organizer_id)->first();
        $transaction_id = Str::uuid();
        if ($wallet) {
            $wallet->transactions()->create([
                'organizer_id' => $organizer_id,
                'type' => WalletTransactionTypeEnum::Credit,
                'source_type' => WalletTransactionSourceAndDestinationTypeEnum::Platform,
                'source' => $reference->payment_method ?? 'Platform',
                'destination_type' => WalletTransactionSourceAndDestinationTypeEnum::Wallet,
                'destination' => 'Wallet',
                'transaction_uuid' => $reference->transaction_uuid,
                'amount' => $amount,
                'referenceable_type' => Payment::class,
                'referenceable_id' => $reference?->id,
                'description' => $notes
            ]);
        }
    }
}
