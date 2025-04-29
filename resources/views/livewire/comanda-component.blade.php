<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-6">Comanda - Mesa #{{ $mesa->id }}</h2>

    {{-- Categorías --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-6">
        @foreach($categorias as $categoria)
            <div wire:click="verProductos({{ $categoria->id }})"
                 class="p-4 rounded-lg shadow text-center cursor-pointer transition
                 {{ $categoriaSeleccionada == $categoria->id ? 'bg-blue-100 border-2 border-blue-500' : 'bg-gray-100 hover:bg-gray-200' }}">
                <h3 class="font-semibold">{{ $categoria->nombre }}</h3>
                <p class="text-xs text-gray-500">{{ $categoria->unidades }} productos</p>
            </div>
        @endforeach
    </div>

    {{-- Productos --}}
    @if($categoriaSeleccionada)
        <div class="bg-gray-50 rounded-lg shadow p-6 mb-8">
            <h3 class="text-lg font-bold mb-4">
                {{ $categorias->firstWhere('id', $categoriaSeleccionada)->categoria }}
            </h3>

            @if($productosFiltrados->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($productosFiltrados as $producto)
                        <div class="p-4 border rounded-lg hover:shadow transition cursor-pointer"
                             wire:click="seleccionarProducto({{ $producto->id }})">
                            <h4 class="font-medium">{{ $producto->nombre }}</h4>
                            <p class="text-sm text-gray-600">${{ number_format($producto->precio_venta, 2) }}</p>
                            <div class="mt-2 flex justify-between text-xs">
                                <span class="bg-gray-200 px-2 py-1 rounded">{{ $producto->tipo }}</span>
                                <span class="{{ $producto->unidades > 0 ? 'text-green-600' : 'text-red-600' }}">
                {{ $producto->unidades }} unidades
            </span>
                            </div>
                        </div>
                    @endforeach

                </div>
            @else
                <p class="text-gray-500 text-center py-4">No hay productos disponibles en esta categoría.</p>
            @endif
        </div>
    @endif

    {{-- Formulario Comanda --}}
    <div class="bg-gray-50 rounded-lg shadow p-6 mb-8">
        <h3 class="text-lg font-semibold mb-4">Nueva Comanda</h3>
        <form wire:submit.prevent="crearComanda" class="grid grid-cols-1 gap-4">
            <div>
                <label class="block text-sm font-medium">Producto</label>
                <select wire:model="stockId" class="w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Selecciona un producto</option>
                    @foreach($stocks as $stock)
                        <option value="{{ $stock->id }}">{{ $stock->nombre }}</option>
                    @endforeach
                </select>
                @error('stockId') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Cantidad</label>
                <input type="number" wire:model="cantidad" class="w-full rounded-md border-gray-300 shadow-sm">
                @error('cantidad') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Estado</label>
                <select wire:model="estado" class="w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Selecciona estado</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="servido">Servido</option>
                </select>
                @error('estado') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Notas</label>
                <textarea wire:model="notas" class="w-full rounded-md border-gray-300 shadow-sm"></textarea>
                @error('notas') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                Crear Comanda
            </button>
        </form>
    </div>

    {{-- Lista de Comandas --}}
    <div>
        <h3 class="text-lg font-semibold mb-4">Comandas registradas</h3>
        @forelse($comandas as $comanda)
            <div class="mb-3 p-4 border rounded-lg shadow-sm">
                <p><strong>ID:</strong> {{ $comanda->id }}</p>
                <p><strong>Producto:</strong> {{ $comanda->stock->nombre ?? '—' }}</p>
                <p><strong>Cantidad:</strong> {{ $comanda->cantidad }}</p>
                <p><strong>Estado:</strong> {{ $comanda->estado }}</p>
                <p><strong>Notas:</strong> {{ $comanda->notas }}</p>
            </div>
        @empty
            <p class="text-gray-600">No hay comandas aún para esta mesa.</p>
        @endforelse
    </div>
</div>
