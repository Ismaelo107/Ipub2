<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Stock;
use Livewire\Component;

class EditStockComponent extends Component
{

    public $productoId;

    public $nombre;
    public $unidades;
    public $precio_venta;
    public $precio_compra;
    public $descripcion;
    public $categoria_id;

    public $categorias;

    public function mount($productoId)
    {
        $this->categorias = Categoria::all();

        if ($productoId) {
            $producto = Stock::findOrFail($productoId);
            $this->productoId = $producto->id;
            $this->nombre = $producto->nombre;
            $this->unidades = $producto->unidades;
            $this->precio_venta = $producto->precio_venta;
            $this->precio_compra = $producto->precio_compra;
            $this->descripcion = $producto->descripcion;
            $this->categoria_id = $producto->categoria_id;
        }
    }

    public function guardarProducto()
    {
        $this->validate(
            [
                'nombre' => 'required|string|max:50',
                'unidades' => 'required|integer|min:1',
                'precio_venta' => 'required|numeric|min:1',
                'precio_compra' => 'required|numeric|min:0',
                'descripcion' => 'nullable|string|max:100',
                'categoria_id' => 'required|integer|min:1'
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'unidades.required' => 'La unidades es requerida',
                'precio_venta.required' => 'El precio es requerido',
                'precio_compra.required' => 'El precio es requerido',
                'categoria_id.required' => 'Agregar una categoria',
            ]
        );

        Stock::updateOrCreate(
            ['id' => $this->productoId],
            [

                'nombre' => $this->nombre,
                'unidades' => $this->unidades,
                'precio_venta' => $this->precio_venta,
                'precio_compra' => $this->precio_compra,
                'descripcion' => $this->descripcion,
                'categoria_id' => $this->categoria_id
            ]);

        session()->flash('message', $this->productoId ? 'Producto actualizado' : 'Producto creado');
        return redirect(route('showStock'));

    }

    public function render()
    {
        return view('livewire.edit-stock-component');
    }
}
