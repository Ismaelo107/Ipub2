<div>
    @if($productos->isEmpty())
        <p class="text-gray-500">No hay productos registrados en el stock.</p>
    @else
        <div class="overflow-x-auto rounded-lg shadow-lg w-3/4 m-auto">
            <table class="w-full table-auto border border-gray-200">
                <thead class="bg-blue-500">
                <tr>
                    <th class="px-4 py-2 text-left text-sm text-gray-700">#</th>
                    <th class="px-4 py-2 text-left text-sm text-gray-700">Nombre</th>
                    <th class="px-4 py-2 text-left text-sm text-gray-700">Unidades</th>
                    <th class="px-4 py-2 text-left text-sm text-gray-700">Categoría</th>
                    <th class="px-4 py-2 text-left text-sm text-gray-700">Precio Venta</th>
                    <th class="px-4 py-2 text-left text-sm text-gray-700">Precio Compra</th>
                    <th class="px-4 py-2 text-left text-sm text-gray-700">Descripción</th>
                    <th class="px-4 py-2 text-left text-sm text-gray-700">Editar</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @foreach($productos as $producto)
                    <tr class="odd:bg-blue-100">
                        <td class="px-4 py-2 text-sm">{{ $producto->id }}</td>
                        <td class="px-4 py-2 text-sm">{{ $producto->nombre }}</td>
                        <td class="px-4 py-2 text-sm">{{ $producto-> unidades }}</td>
                        <td class="px-4 py-2 text-sm">{{  $producto-> categoria->nombre  }}</td>
                        <td class="px-4 py-2 text-sm">${{ number_format($producto->precio_venta, 2) }}</td>
                        <td class="px-4 py-2 text-sm">${{ number_format($producto->precio_compra, 2) }}</td>
                        <td class="px-4 py-2 text-sm">{{$producto-> descripcion ?? 'Sin descripción'}}</td>
                        <td class="px-4 py-2 text-sm">
                            <div class=" item-center">
                                <a href="{{ route('editStock', ['productoId' => $producto->id]) }}"
                                   class="inline-block px-6 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600 transition">
                                    Editar
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <div class="mt-6 text-center">
        <a href="{{ route('stock') }}"
           class="inline-block px-6 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600 transition">
            Insertar Nuevo Producto
        </a>
    </div>
</div>
