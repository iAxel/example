<?php

namespace Database\Factories;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

final class UserFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = User::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => '',
            'email' => '',
            'password' => '',
        ];
    }
}
