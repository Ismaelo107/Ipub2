<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Comanda;
use App\Models\Mesa;
use App\Models\Stock;
use Livewire\Component;

class ComandaComponent extends Component
{
    public $producto;
    public $comandas = [];
    public $stockId;
    public $cantidad;
    public $precio;
    public $estado;
    public $notas;

    public $mesa;
    public $stocks;

    public $categorias;
    public $categoriaSeleccionada = null;
    public $productosFiltrados = [];


    public function verProductos($categoriaId): void
    {
        // Si ya está seleccionada, la deseleccionamos
        if ($this->categoriaSeleccionada == $categoriaId) {
            $this->categoriaSeleccionada = null;
            $this->productosFiltrados = [];
            return;
        }

        $this->categoriaSeleccionada = $categoriaId;
        // Obtener solo productos de esta categoría
        $this->productosFiltrados = Categoria::find($categoriaId)
            ->stocks()
            ->where('disponible', true)
            ->get();
    }

    public function seleccionarProducto($id)
    {
        if ($this->stockId == $id) {
            $this->cantidad = $this->cantidad + 1;
        } else {
            $this->stockId = $id;
            $this->cantidad = 1;
        }
    }


    //Usa el Model bindin que consiste en que el propio laravel busca la mesa por el id automaticamente
    public function mount(Mesa $mesa)
    {
        $this->mesa = $mesa;
        $this->stocks = Stock::all();
        $this->categorias = Categoria::withCount('stocks')->get();

        $this->obtenerComandas();

    }

    public function crearComanda()
    {
        $this->validate([
            'stockId' => 'required|exists:stocks,id',
            'cantidad' => 'required|numeric|min:1',
            //'estado' => 'required|string|max:50',
            'notas' => 'nullable|string',
        ], [
            'stockId.required' => 'Debes seleccionar un producto.',
            'stockId.exists' => 'El producto seleccionado no existe.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.numeric' => 'La cantidad debe ser un número.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',
            //'estado.required' => 'El estado es obligatorio.',
            'estado.string' => 'El estado debe ser texto.',
            'estado.max' => 'El estado no debe superar los 50 caracteres.',
            'notas.string' => 'Las notas deben ser texto.',
        ]);


        //TODO tengo que corregier si no queda productos en el stock
        $stock = Stock::find($this->stockId);

        Comanda::create([
            'mesa_id' => $this->mesa->id,
            'stock_id' => $this->stockId,
            'cantidad' => $this->cantidad,
            'precio' => $stock->precio_venta,
            //'estado' => $this->estado,
            'notas' => $this->notas,
        ]);

        // Restar del stock y guardar
        $stock->unidades -= $this->cantidad;
        $stock->save();

        // Limpiar inputs
        $this->reset(['stockId', 'cantidad', 'notas']);
    }

    public function obtenerComandas()
    {
        $this->comandas = Comanda::where('mesa_id', $this->mesa->id)->get();
    }


    public function render()
    {
        return view('livewire.comanda-component', [
            'mesa' => $this->mesa,  // Pasar $mesa a la vista
        ]);
    }
}
