<?php

namespace App\Livewire;

use App\Models\Mesa;
use Livewire\Component;

class ComandaComponent extends Component
{
    public $mesa;

    public function mount($mesa)
    {
        $this->mesa = Mesa::find($mesa);
    }

    public function render()
    {
        return view('livewire.comanda-component');
    }
}
