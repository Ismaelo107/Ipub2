<?php

namespace App\Livewire;

use App\Models\Mesa;
use Livewire\Component;

class TicketComponent extends Component
{
    public $mesa;
    public $comandas;

    public function mount(Mesa $mesa)
    {
        $this->mesa = $mesa;

        // Traer todas las comandas de la mesa con su producto (stock)
        $this->comandas = $mesa->comandas()->with('stock')->get();
    }

    public function render()
    {
        return view('livewire.ticket-component', [
            'comandas' => $this->comandas,
        ]);
    }
}
