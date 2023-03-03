<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\WalletCharge\WalletChargeService;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    public function test_transaction_add_money_response_is_json(): void
    {
        $wallet_service = new WalletChargeService();

        $transaction = $wallet_service->addMoney(1, 1000);

        $this->assertJson($transaction->toJson());
    }

    public function test_transaction_add_money_valid_response(): void
    {
        $wallet_service = new WalletChargeService();

        $transaction = $wallet_service->addMoney(1, 1000);

        $this->assertArrayHasKey('amount', $transaction->toArray());
        $this->assertArrayHasKey('current_balance', $transaction->toArray());
        $this->assertArrayHasKey('process', $transaction->toArray());
        $this->assertArrayHasKey('user_id', $transaction->toArray());
        $this->assertArrayHasKey('reference_id', $transaction->toArray());
    }

    public function test_transaction_add_money_same_user()
    {
        $user_id = 1;

        $wallet_service = new WalletChargeService();

        $transaction = $wallet_service->addMoney($user_id, 1000);

        $this->assertEquals($user_id, $transaction['user_id']);
    }

    public function test_transaction_add_money_equal_amount()
    {
        $amount = 1000.00;

        $wallet_service = new WalletChargeService();

        $transaction = $wallet_service->addMoney(1, $amount);

        $this->assertSame($amount, $transaction->amount);
    }

    public function test_transaction_add_money_wallet_balance()
    {
        $amount = 1000.00;

        $user = User::query()->find(1);

        $wallet_service = new WalletChargeService();

        $transaction = $wallet_service->addMoney($user->id, $amount);

        $this->assertSame($user->wallet->balance, $transaction->current_balance);
    }
}
