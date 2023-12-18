<?php

namespace Database\Factories;

use App\Models\Tool;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ToolFactory extends Factory
{
    protected $model = Tool::class;

    public function definition(): array
    {
        return [
            'category' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
