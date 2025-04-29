<div class="grid grid-cols-5 gap-4 p-3 justify-center w-auto">
    @foreach($mesas as $mesa)
        <div wire:click="abrirMesa({{ $mesa->id }})" class="p-4 rounded-lg shadow-md text-center w-auto
                                {{ $mesa->comandas->isNotEmpty() ? 'bg-green-400' : 'bg-red-400' }}">

            <h2 class="text-lg font-bold">Mesa #{{ $mesa->id }}</h2>
            <p class="text-sm">Estado: <strong>{{ ucfirst($mesa->estado) }}</strong></p>
            <p class="text-sm">Forma de pago: <strong>{{ ucfirst($mesa->forma_pago) }}</strong></p>
            <p class="text-sm">Total: <strong>${{ number_format($mesa->id, 2) }}</strong></p>


        </div>
    @endforeach
</div>

