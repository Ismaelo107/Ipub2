<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    public function definition(): array
    {
        $categorias = [
            'Cervezas',
            'Vinos',
            'Cócteles',
            'Licores',
            'Whisky',
            'Gin',
            'Vodka',
            'Ron',
            'Bebidas sin alcohol',
            'Shots',
        ];

        return [
            'nombre' => $this->faker->unique()->randomElement($categorias),
        ];
    }
}
