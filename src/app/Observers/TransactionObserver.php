<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public bool $afterCommit = false;

    /**
     * Handle the Transaction "created" event.
     */
    public function creating(Transaction $transaction): void
    {
        $transaction->reference_id = rand(1000, 9999) . now()->timestamp . rand(1000, 9999);
    }
}
