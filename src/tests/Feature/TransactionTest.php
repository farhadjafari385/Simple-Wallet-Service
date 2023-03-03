<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    public function test_add_money_json_structure()
    {
        $response = $this->put('/api/add-money', [
            'user_id' => 1,
            'amount' => 1000,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'reference_id'
            ],
            'error',
        ],
            $response->json()
        );
    }

    public function test_add_money_for_wrong_user_id()
    {
        $response = $this->put('/api/add-money', [
            'user_id' => null,
            'amount' => 1000,
        ]);

        $response->assertStatus(422);
    }
}
