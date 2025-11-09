<?php

namespace App\Models;

use App\Enums\KYCStatusEnum;
use App\Enums\MaritalStatusEnum;
use Illuminate\Database\Eloquent\Model;

class KYC extends Model
{

    protected $guarded = [];

    protected $casts = [
        'status' => KYCStatusEnum::class,
        'details' => 'array',
    ];

    public function getMaritalStatusAttribute()
    {
        return isset($this->attributes['details']['marital_status'])
            ? MaritalStatusEnum::from($this->attributes['details']['marital_status'])
            : null;
    }

    public function setMaritalStatusAttribute($value)
    {
        $this->attributes['details'] = array_merge(
            $this->attributes['details'] ?? [],
            ['marital_status' => $value instanceof MaritalStatusEnum ? $value->value : $value]
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
