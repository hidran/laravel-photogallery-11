<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'album_name' => $this->faker->text(60),
            'album_thumb' => $this->faker->imageUrl(),
            'description' => $this->faker->text(120),
            'created_at' => $this->faker->dateTime(),
            'user_id' => User::factory(),
        ];
    }
}
