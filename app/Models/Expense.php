<?php

namespace App\Models;

use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = [];

    protected $casts = [
        'payment_status' => PaymentStatusEnum::class
    ];

    public function category()
    {
        return $this->belongsTo(EventExpenseCategory::class, 'expense_category_id');
    }
}
