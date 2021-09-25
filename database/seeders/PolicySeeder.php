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
                'name' => 'Users',
            ],
            [
                'name' => 'Roles',
            ],
            [
                'name' => 'Policies',
            ],
            [
                'name' => 'Permissions',
            ],
        ]);
    }
}
