<?php

namespace Database\Factories;

use App\Models\Role;

use Illuminate\Database\Eloquent\Factories\Factory;

final class RoleFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Role::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => '',
        ];
    }
}
