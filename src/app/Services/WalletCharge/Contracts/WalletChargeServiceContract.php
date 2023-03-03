<?php

namespace App\Services\WalletCharge\Contracts;

use App\Enums\TransactionProcessEnum;
use App\Models\User;
use App\Repository\TransactionRepository;
use App\Repository\WalletRepository;

abstract class WalletChargeServiceContract implements WalletChargeServiceInterface
{
    protected TransactionRepository $transactions_repository;
    protected WalletRepository $wallet_repository;

    public function __construct()
    {
        $this->transactions_repository = new TransactionRepository();
        $this->wallet_repository = new WalletRepository();
    }

    protected function user($user_id): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        return User::query()->findOrFail($user_id);
    }
}
