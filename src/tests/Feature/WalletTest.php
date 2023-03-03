<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WalletTest extends TestCase
{
    /**
     * Get Balance standard json structure.
     */
    public function test_get_balance_json_structure(): void
    {
        $response = $this->get('/api/get-balance/1');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'balance'
            ],
            'error',
        ],
            $response->json()
        );
    }
}
