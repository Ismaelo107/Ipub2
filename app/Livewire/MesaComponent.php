<?php

namespace App\Livewire;

use App\Models\Mesa;
use Livewire\Component;

class MesaComponent extends Component
{
    public $mesas;


    public function mount()
    {
        $this->mesas = Mesa::all();
    }

    public function abrirMesa($mesaId)
    {
        $mesa = Mesa::find($mesaId);
        if ($mesa) {
            $mesa->estado = 'abierta';
            $mesa->save();
            $this->mesas = Mesa::all();

            return redirect()->route('comanda', ['mesa' => $mesaId]);
        }
    }

    public function render()
    {
        return view('livewire.mesa-component');
    }
}
