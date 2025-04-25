<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Comanda de Mesa #{{ $mesa->id }}</h2>

    <form wire:submit.prevent="crearComanda" class="mb-6">
        <div class="grid grid-cols-1 gap-4">
            <!-- Producto -->
            <div>
                <label for="stockId" class="block text-sm font-medium text-gray-700">Producto</label>
                <select wire:model="stockId" id="stockId"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Selecciona un producto</option>
                    @foreach($stocks as $stock)
                        <option value="{{ $stock->id }}">{{ $stock->nombre }}</option>
                    @endforeach
                </select>
                @error('stockId') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Cantidad -->
            <div>
                <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
                <input type="number" wire:model="cantidad" id="cantidad"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('cantidad') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Estado -->
            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                <select wire:model="estado" id="estado" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Selecciona estado</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="servido">Servido</option>
                </select>
                @error('estado') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Notas -->
            <div>
                <label for="notas" class="block text-sm font-medium text-gray-700">Notas</label>
                <textarea wire:model="notas" id="notas"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                @error('notas') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Botón -->
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Crear Comanda
                </button>
            </div>
        </div>
    </form>
    <!-- Lista de comandas -->
    @if($comandas && count($comandas) > 0)
        <h3 class="text-xl font-semibold mt-6 mb-2">Comandas registradas ({{ count($comandas) }})</h3>
        <div class="space-y-4">
            @foreach($comandas as $comanda)
                <div class="p-4 border rounded-lg shadow-sm">
                    <p><span class="font-semibold">ID:</span> {{ $comanda->id }}</p>
                    <p><span class="font-semibold">Producto:</span> {{ $comanda->stock->nombre ?? '—' }}</p>
                    <p><span class="font-semibold">Cantidad:</span> {{ $comanda->cantidad }}</p>
                    <p><span class="font-semibold">Estado:</span> {{ $comanda->estado }}</p>
                    <p><span class="font-semibold">Notas:</span> {{ $comanda->notas }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600 mt-4">No hay comandas aún para esta mesa.</p>
    @endif
</div>
