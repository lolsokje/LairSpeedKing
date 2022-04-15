<?php

namespace Database\Factories;

use App\Enums\ContentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'content_type' => ContentType::BASE,
            'link' => $this->faker->url(),
        ];
    }

    public function dlc(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'content_type' => ContentType::DLC,
            ];
        });
    }

    public function mod(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'content_type' => ContentType::MOD,
            ];
        });
    }
}
