<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slide>
 */
class SlideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $index = $this->faker->numberBetween(1, 100);
        $randomImage = 'https://picsum.photos/1920/1080?random=' . $this->faker->unique()->numberBetween(1, 1000);

        return [
            'title' => 'Slide',
            'description' => '',
            'img' => $randomImage
        ];
    }
}
