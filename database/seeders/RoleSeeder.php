<?php

namespace Database\Seeders;

use App\Models\Role;

use Illuminate\Database\Seeder;

final class RoleSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Role::factory()->create([
            'name' => 'Administrator',
        ]);
    }
}
