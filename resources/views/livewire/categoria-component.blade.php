<div>

    <form wire:submit.prevent="guardarCategoria" class=" m-auto w-1/2 rounded-lg shadow-2xl p-4 space-y-6">
        <h1 class="text-4xl font-bold">Crear categoria</h1>

        <div>
            <label class="block">Nombre Categoria:</label>
            <input type="text" wire:model="nombre"
                   class="w-full rounded-md border-gray-500 shadow-sm "
                   placeholder="Nombre de la categoria">
            @error('nombre')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

        </div>
        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
            Guardar Categoria
        </button>
    </form>


</div>
