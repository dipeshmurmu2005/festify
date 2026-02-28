<?php

namespace App\Models;

use App\Enums\WalletTransactionTypeEnum;
use App\Enums\WithdrawalRequestEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'balance',
        'credit_amount',
        'available_amount_for_withdrawal'
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class, 'wallet_id');
    }


    public function getBalanceAttribute()
    {
        $totalCredit = $this->transactions()->where('type', WalletTransactionTypeEnum::Credit)->sum('amount');
        $totalDebit = $this->transactions()->where('type', WalletTransactionTypeEnum::Debit)->sum('amount');
        return $totalCredit - $totalDebit;
    }

    public function getCreditAmountAttribute()
    {
        $totalCredit = $this->transactions()->where('type', WalletTransactionTypeEnum::Credit)->sum('amount');
        return $totalCredit;
    }

    private function totalWithdrawalRequestedAmount()
    {
        return $this->organizer->withdrawalRequests()->where('status', WithdrawalRequestEnum::Pending)->sum('amount');
    }

    public function getAvailableAmountForWithdrawalAttribute()
    {
        return $this->getBalanceAttribute() - $this->totalWithdrawalRequestedAmount();
    }
}
