<?php

namespace App\Services\WalletCharge\Contracts;

use App\Exceptions\TransactionFailedException;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
interface WalletChargeServiceInterface
{
    /**
     *
     * Add Money To User
     *
     * @param int $user_id
     * @param float $amount
     * @return Transaction|Model
     * @throws TransactionFailedException
     */
    public function addMoney(int $user_id, float $amount): Transaction|Model;
}
