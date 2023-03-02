<?php

namespace App\Repository;

use App\Enums\TransactionProcessEnum;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class TransactionRepository
{
    public function total(): float
    {
        return Transaction::query()->sum('amount');
    }

    public function count(): int
    {
        return Transaction::query()->count('amount');
    }

    public function transaction(User|Model $user, float $amount, TransactionProcessEnum $process): Model
    {
        $latest = $user->transactions()->orderByDesc('id')->firstOrNew();

        return $user->transactions()->create([
            'hash' => $this->generateHash($latest),
            'amount' => $amount,
            'current_balance' => $user->wallet->balance,
            'process' => $process,
        ]);
    }

    private function generateHash(Transaction $latest): string
    {
        return Hash::make($latest->hash . ':' . $latest->user_id . ':' . $latest->amount . ':' . $latest->current_balance);
    }
}
