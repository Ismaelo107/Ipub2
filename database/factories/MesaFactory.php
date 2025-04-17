<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mesa>
 */
class MesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'estado' => $this->faker->randomElement(['abierta', 'pendiente', 'cerrada']),
            'aPagar' => $this->faker->randomFloat(2, 3, 200),
            'formaPago' => $this->faker->randomElement(['efectivo', 'tarjeta'])
        ];
    }
}
