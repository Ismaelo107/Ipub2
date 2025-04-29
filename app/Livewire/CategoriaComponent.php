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
            [
                'nombre' => 'required'
            ],
            [
                'nombre.required' => 'El campo nombre es requerido'
            ]
        );

        Categoria::create([
            'nombre' => $this->nombre
        ]);


        return redirect(route('stock'));
    }


    public function render()
    {
        return view('livewire.categoria-component');
    }
}
