<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->words(3, true);
        return [
            'image' => 'https://picsum.photos/800/600?random=' . $this->faker->unique()->numberBetween(1, 1000),
            'categories' => $this->faker->randomElements(['Painting', 'Plumbing', 'Electrical', 'Roofing', 'Heating'], 2),
            'title' => $title,
            'link' => Str::slug($title)
        ];
    }
}
