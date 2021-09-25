<?php

namespace Database\Factories;

use App\Models\Permission;

use Illuminate\Database\Eloquent\Factories\Factory;

final class PermissionFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Permission::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => '',
            'policy_id' => '',
        ];
    }
}
