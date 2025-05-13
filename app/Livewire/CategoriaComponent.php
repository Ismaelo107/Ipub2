<?php

namespace App\Livewire;

use App\Models\Categoria;
use Livewire\Component;

class CategoriaComponent extends Component
{
    public $nombre;

    public function guardarCategoria()
    {
        $this->validate(
            ['nombre' => 'required|unique:categorias,nombre'],
            ['nombre.required' => 'El campo nombre es requerido',
                'nombre.unique' => 'Esta categoria ya existe'
            ]
        );

        Categoria::create(
            ['nombre' => $this->nombre]
        );

        return redirect(route('stock'));
    }


    public function render()
    {
        return view('livewire.categoria-component');
    }
}
