<?php

namespace Database\Factories;

use App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\Factory;

final class PolicyFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Policy::class;

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
