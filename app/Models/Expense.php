<?php

namespace App\Models;

use App\Enums\PaymentStatusEnum;
use App\Traits\BelongsToOrganizer;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use BelongsToOrganizer;

    protected $guarded = [];

    protected $casts = [
        'payment_status' => PaymentStatusEnum::class
    ];

    public function category()
    {
        return $this->belongsTo(EventExpenseCategory::class, 'expense_category_id');
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}
