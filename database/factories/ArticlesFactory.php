<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articles>
 */
class ArticlesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(10, true),
            'description' => $this->faker->sentence(45),
            'image' => $this->faker->imageUrl(),
            'body' => $this->faker->sentence(50),
            'publish' => $this->faker->boolean(),
            'user_id' => 1,
        ];
    }
}
