<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'body'=> $this->faker->sentence(),
            'user_id'=> $this->faker->numberBetween(1,20),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
