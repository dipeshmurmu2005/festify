<?php

namespace App\Enums;

enum PlatformTransactionStatusEnum: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case REVERSED = 'reversed';
}
