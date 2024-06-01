<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'post_id' => $this->faker->numberBetween(1, 10), // Adjust as per your post IDs
            'user_id' => $this->faker->numberBetween(1, 10), // Adjust as per your user IDs
            'content' => $this->faker->paragraph,
        ];
    }
}
