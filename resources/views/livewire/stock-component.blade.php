<div>

    <form wire:submit.prevent="guardarProducto" class="rounded-2xl shadow-2xl w-1/2 m-auto p-12 space-y-5 font-medium">
        <h1 class="text-4xl font-extrabold">Insertar Producto en el Stock</h1>
        <div>
            <label class="block">Nombre Producto</label>
            <input type="text" wire:model="nombre"
                   class="w-full mt-1 rounded-md border-gray-300 shadow-sm"
                   placeholder="Nombre Producto">
            @error('nombre')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div>
            <label class="block">Unidades</label>
            <input type="number" wire:model="unidades"
                   class="w-full mt-1 rounded-md border-gray-300 shadow-sm"
                   placeholder="Número de producto">
            @error('unidades')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div>
            <label class="block">Precio Venta</label>
            <input type="number" wire:model="precio_venta"
                   class="w-full mt-1 rounded-md border-gray-300 shadow-sm"
                   placeholder="Precio Venta">
            @error('precio_venta')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div>
            <label class="block">Precio Compra</label>
            <input type="number" wire:model="precio_compra"
                   class="w-full mt-1 rounded-md border-gray-300 shadow-sm"
                   placeholder="Precio Compra">
            @error('precio_compra')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

        </div>

        <div>
            <label class="block">Descripción</label>
            <input type="text" wire:model="descripcion"
                   class="w-full mt-1 rounded-md border-gray-300 shadow-sm h-16"
                   placeholder="Descripción del producto">
        </div>

        <div>
            <label class="block">Categoria</label>
            <select wire:model="categoria_id">
                <option value="">Seleccionar una categoria</option>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}"> {{$categoria->nombre}}</option>
                @endforeach
            </select>

            @error('categoria_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            <a href="{{route('categoria')}}"
               class=" bg-red-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
                Añadir
            </a>
            @enderror
        </div>

        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
            Guardar Producto
        </button>

    </form>
</div>
