<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Owner',
            'email' => 'owner@example.test',
            'password' => 'secret',
        ]);
    }
}
