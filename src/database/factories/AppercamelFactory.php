<?php

namespace Database\Factories;

use App\Models\appercamel;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppercamelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = appercamel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->lastName() . ' ' . $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'building' => $this->faker->optional(0.7)->sentence(),
            'tel' => $this->faker->numerify('09########'),
            'gender' => $this->faker->randomElement(['1', '2', '3']),
            'inquiry_type' => $this->faker->randomElement(['delivery', 'exchange', 'trouble', 'shop', 'other']),
            'content' => $this->faker->text(100),
        ];
    }
}
