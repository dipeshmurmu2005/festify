<?php

namespace App\Services\Organizer;


class WalletStatsService
{
    private $wallet;
    public function __construct()
    {
        $this->wallet = auth()->user()->organizer->wallet;
    }

    public function balance()
    {
        return $this->wallet->balance;
    }
}
