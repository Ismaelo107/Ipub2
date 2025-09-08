<div class="bg-white rounded-xl shadow-md p-6">
    <h3 class="text-lg font-bold mb-4 text-gray-800">Resumen del Ticket</h3>

    @if($comandas->isNotEmpty())
        <table class="w-full text-sm text-left text-gray-700">
            <thead>
            <tr class="border-b">
                <th class="py-2">Producto</th>
                <th class="py-2 text-center">Cantidad</th>
                <th class="py-2 text-right">Precio U.</th>
                <th class="py-2 text-right">Subtotal</th>
            </tr>
            </thead>
            <tbody>
            @php $total = 0; @endphp
            @foreach($comandas as $comanda)
                @php
                    $subtotal = $comanda->precio * $comanda->cantidad;
                    $total += $subtotal;
                @endphp
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2">{{ $comanda->stock->nombre ?? '—' }}</td>
                    <td class="py-2 text-center">{{ $comanda->cantidad }}</td>
                    <td class="py-2 text-right">${{ number_format($comanda->precio, 2) }}</td>
                    <td class="py-2 text-right font-semibold">${{ number_format($subtotal, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr class="border-t font-bold">
                <td colspan="3" class="py-2 text-right">Total:</td>
                <td class="py-2 text-right text-green-600">${{ number_format($total, 2) }}</td>
            </tr>
            </tfoot>
        </table>
    @else
        <p class="text-gray-500">No hay productos en la comanda todavía.</p>
    @endif
</div>
