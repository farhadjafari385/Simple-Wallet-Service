<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user_id = DB::table('users')->insertGetId([
            'first_name' => 'Farhad',
            'last_name' => 'Jafari',
            'email' => 'contact@farhadjafari.info',
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),
        ]);

        DB::table('wallets')->insert([
            'user_id' => $user_id,
            'balance' => 0,
            'status' => 1
        ]);
    }
}
