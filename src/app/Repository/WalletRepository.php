<?php

namespace App\Repository;

use App\Models\User;
use App\Models\Wallet;

class WalletRepository
{
    public function getBalance(User $user): float
    {
        return $user?->wallet->balance;
    }

    public function transfer(Wallet $wallet, float $amount): bool
    {
        $wallet->balance += $amount;

        return $wallet->save();
    }
}
