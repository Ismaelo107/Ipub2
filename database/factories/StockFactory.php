<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    protected $model = Stock::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->word,
            'precio_venta' => $this->faker->randomFloat(2, 1, 100), // Precio aleatorio
            'precio_compra' => $this->faker->randomFloat(2, 1, 50),  // Precio de compra aleatorio
            'unidades' => $this->faker->numberBetween(1, 100), // Unidades disponibles
            'descripcion' => $this->faker->sentence,
            'categoria_id' => Categoria::inRandomOrder()->first()->id, // Asocia el producto a una categoría aleatoria
        ];
    }
}
