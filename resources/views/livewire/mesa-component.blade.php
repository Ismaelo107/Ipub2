<div>
    <h1>Hola desde el componente de mesa</h1>

    <div class="grid grid-cols-3 gap-6 ">
        @foreach($mesas as $mesa)
            <div wire:click="abrirMesa({{$mesa->id}})"
                 class="bg-blue-500 rounded-lg text-center p-4">
                <h2>
                    Mesa #{{$mesa ->id}}
                </h2>
                <h4>
                    Estado: {{$mesa ->estado}}
                </h4>
                <a href="{{route('comanda',[ 'mesa' => $mesa->id ])}}">
                    Ir a comanda
                </a>
            </div>
        @endforeach
    </div>
</div>

