<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(60),
            'description' => $this->faker->text(128),
            'img_path' => $this->faker->imageUrl(),
            //  'created_at' => $this->faker->dateTime(),
            'album_id' => Album::factory(),
        ];
    }
}
