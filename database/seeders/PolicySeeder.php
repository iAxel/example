<?php

namespace Database\Seeders;

use App\Models\Policy;

use Illuminate\Database\Seeder;

final class PolicySeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Policy::factory()->createMany([
            [
                'name' => 'User',
            ],
            [
                'name' => 'Role',
            ],
            [
                'name' => 'Policy',
            ],
            [
                'name' => 'Permission',
            ],
        ]);
    }
}
