<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Mesa;
use App\Models\Stock;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Mesa::factory(10)->create();
        $categorias = Categoria::factory(10)->create();

        foreach ($categorias as $categoria) {
            Stock::factory()
                ->count(10)
                ->create([
                    'categoria_id' => $categoria->id
                ]);
        }
    }
}
