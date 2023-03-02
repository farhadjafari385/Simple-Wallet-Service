<?php

namespace App\Services\WalletCharge;

use App\Models\Transaction;
use App\Exceptions\TransactionFailedException;
use App\Services\WalletCharge\Contracts\WalletChargeServiceContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class WalletChargeService extends WalletChargeServiceContract
{
    /**
     *
     * @inheritDoc
     *
     */
    public function addMoney(int $user_id, float $amount): Transaction|Model
    {
        $user = $this->user($user_id);

        try {
            return $this->process(
                $user,
                $amount
            );
        } catch (\Exception $e) {
            $this->rollback($e);
        }
    }

    /**
     * @param $user
     * @param $amount
     * @return Model
     */
    private function process($user, $amount): \Illuminate\Database\Eloquent\Model
    {
        DB::beginTransaction();

        $this->wallet_repository->transfer($user->wallet, $amount);

        $transaction = $this->transactions_repository->transaction(
            $user,
            $amount,
            $this->getProcess($amount)
        );

        DB::commit();

        return $transaction;
    }

    /**
     * @throws TransactionFailedException
     */
    private function rollback($e)
    {
        DB::rollBack();

        throw new TransactionFailedException('Add money failed, please try again later.', [
            $e->getMessage()
        ]);
    }
}
