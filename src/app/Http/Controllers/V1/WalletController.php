<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Repository\WalletRepository;
use App\Models\User;

class WalletController extends Controller
{
    public function __construct(private readonly WalletRepository $wallet_repository)
    {
    }

    public function getBalance(User $user): JsonResponse
    {
        return success(
            'OK',
            [
                'balance' => $this->wallet_repository->getBalance($user)
            ]
        );
    }
}
