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

    public function eliminar($id)
    {
        try {
            $producto = Stock::find($id);

            if (!$producto) {
                session()->flash('mensaje', 'Producto no encontrado.');
                return;
            }

            $producto->delete();

            // Actualizar la lista de productos
            $this->productos = Stock::with('categoria')->get();

            session()->flash('mensaje', 'Producto eliminado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Verificar si el error es por restricción de clave foránea
            if ($e->getCode() == '23000') {
                session()->flash('mensaje', 'No se puede eliminar el producto porque está asociado a otras entidades (por ejemplo, comandas).');
            } else {
                session()->flash('mensaje', 'Ocurrió un error al intentar eliminar el producto.');
            }
        }
    }



    public function render()
    {
        return view('livewire.show-stock-component');
    }
}
