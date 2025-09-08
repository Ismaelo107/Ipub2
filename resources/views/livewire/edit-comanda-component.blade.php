<div class="p-4 border rounded-lg shadow-sm bg-white mb-3">
    @if ($editando)
        <div class="space-y-2">
            <label class="block">
                <span class="text-sm font-medium">Cantidad</span>
                <input type="number" wire:model="cantidad"
                       class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </label>
            <label class="block">
                <span class="text-sm font-medium">Notas</span>
                <textarea wire:model="notas"
                          class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </label>
            <div class="flex gap-4 mt-4">
                <button wire:click="actualizar"
                        class="px-5 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                    Guardar
                </button>
                <button wire:click="$set('editando', false)"
                        class="px-5 py-2 border rounded-full text-gray-700 border-gray-300 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Cancelar
                </button>
            </div>
        </div>
    @else
        <p><strong>ID:</strong> {{ $comanda->id }}</p>
        <p><strong>Producto:</strong> {{ $comanda->stock->nombre ?? '—' }}</p>
        <p><strong>Cantidad:</strong> {{ $comanda->cantidad }}</p>
        <p><strong>Notas:</strong> {{ $comanda->notas }}</p>
        <p><strong>Hora:</strong>
            {{ $comanda->updated_at->ne($comanda->created_at)
                ? $comanda->updated_at->format('H:i')
                : $comanda->created_at->format('H:i') }}
        </p>
        <label class="block">
            <span class="text-sm font-medium">Cantidad</span>
            <div class="flex items-center gap-2">
                <button type="button"
                        wire:click="decrementarCantidad"
                        class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 focus:outline-none">
                    –
                </button>
                <input type="number" wire:model="cantidad"
                       class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="button"
                        wire:click="incrementarCantidad"
                        class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 focus:outline-none">
                    +
                </button>
            </div>
        </label>


        <div class="flex gap-4 mt-4">
            <button wire:click="$set('editando', true)"
                    class="px-5 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Editar
            </button>
            <button wire:click="eliminar"
                    class="px-5 py-2 bg-red-600 text-white rounded-full hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">
                Eliminar
            </button>
        </div>
    @endif

    {{-- Esto está hecho con Alpine.js No lo entiendo muy bien (Hecho con GPT) --}}
    @if (session()->has('mensaje'))
        <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 1000)"
                x-show="show"
                class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded-lg"
        >
            {{ session('mensaje') }}
        </div>
    @endif
</div>


