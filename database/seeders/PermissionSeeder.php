<?php

namespace Database\Seeders;

use App\Models\Permission;

use Illuminate\Database\Seeder;

final class PermissionSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Permission::factory()->createMany([
            [
                'name' => 'Create',
                'policy_id' => 1,
            ],
            [
                'name' => 'Read',
                'policy_id' => 1,
            ],
            [
                'name' => 'Update',
                'policy_id' => 1,
            ],
            [
                'name' => 'Delete',
                'policy_id' => 1,
            ],
            [
                'name' => 'Create',
                'policy_id' => 2,
            ],
            [
                'name' => 'Read',
                'policy_id' => 2,
            ],
            [
                'name' => 'Update',
                'policy_id' => 2,
            ],
            [
                'name' => 'Delete',
                'policy_id' => 2,
            ],
            [
                'name' => 'Read',
                'policy_id' => 3,
            ],
            [
                'name' => 'Read',
                'policy_id' => 4,
            ],
        ]);
    }
}
