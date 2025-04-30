<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Stock;
use Livewire\Component;

class ShowStockComponent extends Component
{
    public $productos;

    public function mount()
    {
        $this->productos = Stock::with('categoria')->get();
    }



    public function render()
    {
        return view('livewire.show-stock-component');
    }
}
