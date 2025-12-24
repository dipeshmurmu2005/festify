<?php

namespace App\Models;

use App\Enums\WalletTransactionTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $guarded = [];

    protected $appends = [
        'balance',
        'credit_amount'
    ];

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
}
