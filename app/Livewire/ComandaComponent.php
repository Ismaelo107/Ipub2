<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Comanda;
use App\Models\Mesa;
use App\Models\Stock;
use Livewire\Component;

class ComandaComponent extends Component
{
    public $producto, $stockId, $cantidad, $precio, $estado, $notas, $mesa, $stocks, $categorias;

    public $comandas = [], $productosFiltrados = [], $categoriaSeleccionada = null;

    protected $listeners = ['comandaEliminada' => 'actualizarProductosEliminado', 'comandaUpdated' => 'obtenerComanda'];


    //Usa el Model bindin que consiste en que el propio laravel busca la mesa por el id automaticamente
    public function mount(Mesa $mesa)
    {
        $this->mesa = $mesa;
        $this->stocks = Stock::all();
        $this->categorias = Categoria::withCount('stocks')->get();

        $this->obtenerComandas();

        // Selecciona automáticamente la primera categoría si hay
        if ($this->categorias->isNotEmpty()) {
            $this->categoriaSeleccionada = $this->categorias->first()->id;
            $this->productosFiltrados = Categoria::find($this->categoriaSeleccionada)
                ->stocks()
                ->where('disponible', true)
                ->get();
        }

    }



    public function actualizarProductosEliminado($stockId, $cantidad)
    {
        $stock = Stock::find($stockId);

        if ($stock) {
            $stock->unidades += $cantidad;
            $stock->save();
        }

        // Refrescar comandas y productos filtrados
        $this->obtenerComandas();

        if ($this->categoriaSeleccionada) {
            $this->productosFiltrados = Categoria::find($this->categoriaSeleccionada)
                ->stocks()
                ->where('disponible', true)
                ->get();
        }
    }


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
        $this->obtenerComandas();

        if ($this->stockId == $id) {

            $this->cantidad = $this->cantidad + 1;
        } else {

            $this->stockId = $id;
            $this->cantidad = 1;
        }
    }



    public function crearComanda()
    {
        $this->validate([
            'stockId' => 'required|exists:stocks,id',
            'cantidad' => 'required|numeric|min:1',
            'notas' => 'nullable|string',
        ]);

        $stock = Stock::find($this->stockId);

        // Buscar si ya existe una comanda con este producto y mismas notas
        $comandaExistente = Comanda::where('mesa_id', $this->mesa->id)
            ->where('stock_id', $this->stockId)
            ->where('notas', $this->notas)
            ->first();

        if ($comandaExistente) {

            // Si ya existe, solo actualizamos la cantidad
            $comandaExistente->cantidad += $this->cantidad;
            $comandaExistente->save();
        } else {

            // Si no existe, creamos una nueva comanda
            Comanda::create([
                'mesa_id' => $this->mesa->id,
                'stock_id' => $this->stockId,
                'cantidad' => $this->cantidad,
                'precio' => $stock->precio_venta,
                'notas' => $this->notas,
            ]);
        }

        // Descontar del stock
        $stock->unidades -= $this->cantidad;
        $stock->save();

        // Limpiar inputs
        $this->reset(['stockId', 'cantidad', 'notas']);
    }


    public function obtenerComandas()
    {
        $this->comandas = Comanda::where('mesa_id', $this->mesa->id)
            ->orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

    }


    public function render()
    {
        return view('livewire.comanda-component', [
            'mesa' => $this->mesa,  // Pasar $mesa a la vista
        ]);

    }
}
