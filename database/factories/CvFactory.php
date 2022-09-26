<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cv>
 */
class CvFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'address' => fake()->address(),
            'education' => fake()->randomElement(['Symfony', 'Laravel', 'Yii', 'C#', 'GoLang', 'Python', 'PHP', 'Codeigniter', 'NodeJS', 'VueJS']),
            'experience' => fake()->numberBetween(0, 10),
            'work' => fake()->jobTitle(),
        ];
    }
}
