<?php

namespace App\Http\Controllers\V1;

use App\Http\Resources\TransactionAddMoneyResource;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionAddMoneyRequest;
use App\Services\WalletCharge\WalletChargeService;
use App\Exceptions\TransactionFailedException;

class TransactionController extends Controller
{
    public function __construct(private readonly WalletChargeService $wallet_charge_service)
    {
    }

    public function index(User $user)
    {
        return success(
            'OK',
            [
                'transactions' => $user->transactions
            ]
        );
    }

    /**
     * @throws TransactionFailedException
     */
    public function addMoney(TransactionAddMoneyRequest $request): \Illuminate\Http\JsonResponse
    {
        $transaction = $this->wallet_charge_service->addMoney(
            $request->user_id,
            $request->amount
        );

        return success('OK', new TransactionAddMoneyResource($transaction));
    }
}
