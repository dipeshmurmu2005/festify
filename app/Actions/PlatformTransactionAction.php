<?php

namespace App\Actions;

use App\Enums\PlatformTransactionStatusEnum;
use App\Enums\PlatformTransactionTypeEnum;
use App\Enums\TransactionPurposeEnum;
use App\Models\Organizer;
use App\Models\PlatformAccount;
use App\Models\PlatformTransaction;
use Filament\Support\Enums\Platform;

class PlatformTransactionAction
{
    public function credit($data)
    {
        $platformTransaction = PlatformTransaction::create([
            'beneficiary_type' => $data['beneficiary_type'],
            'beneficiary_id' => $data['beneficiary_id'],
            'type' => PlatformTransactionTypeEnum::CREDIT,
            'amount' => $data['amount'],
            'purpose' => $data['purpose'],
            'status' => PlatformTransactionStatusEnum::COMPLETED,
            'referenceable_type' => $data['referenceable_type'],
            'referenceable_id' => $data['referenceable_id'],
            'payment_id' => isset($data['payment_id']) ? $data['payment_id'] : null,
            'origin' => $data['origin'],
            'initiator_type' => $data['initiator_type'],
            'initiator_id' => $data['initiator_id'],
            'organizer_id' => isset($data['organizer_id']) ? $data['organizer_id'] : null,
        ]);
        if ($data['organizer_id'] && $platformTransaction->type == PlatformTransactionTypeEnum::CREDIT && $data['purpose'] == TransactionPurposeEnum::TICKET_PURCHASE) {
            $data['purpose'] = TransactionPurposeEnum::TICKET_EARNING;
            $this->creditOrganizerWallet($data);
        }
    }

    private function creditOrganizerWallet($data)
    {
        $organizer = Organizer::find($data['organizer_id']);
        $platformTransaction = PlatformTransaction::create([
            'beneficiary_type' => Organizer::class,
            'beneficiary_id' => $organizer->id,
            'type' => PlatformTransactionTypeEnum::CREDIT,
            'amount' => $data['amount'],
            'purpose' => $data['purpose'],
            'status' => PlatformTransactionStatusEnum::COMPLETED,
            'referenceable_type' => $data['referenceable_type'],
            'referenceable_id' => $data['referenceable_id'],
            'payment_id' => isset($data['payment_id']) ? $data['payment_id'] : null,
            'origin' => $data['origin'],
            'initiator_type' => PlatformAccount::class,
            'initiator_id' => PlatformAccount::first()->id,
            'organizer_id' => isset($data['organizer_id']) ? $data['organizer_id'] : null,
        ]);

        $walletAction = new WalletTransactionAction();
        $walletAction->credit($data['organizer_id'], $data['amount'], $data['purpose']);
    }
}
