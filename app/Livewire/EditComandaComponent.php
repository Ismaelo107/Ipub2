<?php

namespace App\Livewire;

use App\Models\Comanda;
use Livewire\Component;

class EditComandaComponent extends Component
{
    public Comanda $comanda;

    public $editando = false;
    public $cantidad;
    public $notas;

    public function mount(Comanda $comanda)
    {
        $this->comanda = $comanda;
        $this->cantidad = $comanda->cantidad;
        $this->notas = $comanda->notas;
    }

    public function incrementarCantidad()
    {
        $this->cantidad++;
    }

    public function decrementarCantidad()
    {
        if ($this->cantidad > 0) {
            $this->cantidad--;
        }
    }


    public function actualizar()
    {
        $this->validate([
            'cantidad' => 'required|integer|min:1',
            'notas' => 'nullable|string|max:255',
        ]);

        $stock = $this->comanda->stock;

        $cantidadAnterior = $this->comanda->cantidad;
        $diferencia = $this->cantidad - $cantidadAnterior;

        if ($diferencia > 0) {
            // Quiero aumentar la cantidad, verifico stock
            if ($stock->unidades < $diferencia) {
                session()->flash('mensaje', 'No hay suficiente stock disponible para aumentar la cantidad.');
                return;
            }

            $stock->unidades -= $diferencia;
        } elseif ($diferencia < 0) {
            // Disminuyo cantidad, devuelvo al stock
            $stock->unidades += abs($diferencia);
        }

        $stock->save();

        // Actualizar la comanda
        $this->comanda->update([
            'cantidad' => $this->cantidad,
            'notas' => $this->notas,
        ]);

        $this->editando = false;

        session()->flash('mensaje', 'Comanda actualizada correctamente.');

    }


    public function eliminar()
    {
        $stockId = $this->comanda->stock_id;
        $cantidad = $this->comanda->cantidad;

        $this->comanda->delete();

        // Emitir evento al padre con stockId y cantidad
        $this->dispatch('comandaEliminada', stockId: $stockId, cantidad: $cantidad);

        session()->flash('mensaje', 'Comanda eliminada correctamente.');
    }


    public function render()
    {

        return view('livewire.edit-comanda-component');
    }
}
