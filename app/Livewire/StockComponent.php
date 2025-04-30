<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Stock;
use Livewire\Component;

class StockComponent extends Component
{
    public $nombre, $unidades, $precio_venta, $precio_compra, $descripcion, $categoria_id, $categorias;

    public function mount()
    {
        $this->categorias = Categoria::all();
    }


    public function guardarProducto()
    {
        $this->validate(
            [
                'nombre' => 'required|string|max:50|unique:stocks,nombre',
                'unidades' => 'required|integer|min:1',
                'precio_venta' => 'required|numeric|min:1',
                'precio_compra' => 'required|numeric|min:0',
                'descripcion' => 'nullable|string|max:100',
                'categoria_id' => 'required|integer|min:1'
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'nombre.unique' => 'El nombre de este producto ya existe',
                'unidades.required' => 'La unidades es requerida',
                'precio_venta.required' => 'El precio es requerido',
                'precio_compra.required' => 'El precio es requerido',
                'categoria_id.required' => 'Agregar una categoria',
            ]
        );

        Stock::create([
            'nombre' => $this->nombre,
            'unidades' => $this->unidades,
            'precio_venta' => $this->precio_venta,
            'precio_compra' => $this->precio_compra,
            'descripcion' => $this->descripcion,
            'categoria_id' => $this->categoria_id
        ]);

        return redirect(route('showStock'));

    }

    public function render()
    {
        return view('livewire.stock-component');
    }
}
