<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Blog\Entities\Comment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Blog\Entities\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

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
        ];
    }
}
