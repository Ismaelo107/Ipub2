<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite('resources/css/app.css')
    @livewireStyles

</head>
<body>
<div class=" bg-blue-300 p-3 mb-3 h-16 space-x-4">
    <a class=" text-4xl font-bold" href="{{route('home')}}">Ipub2</a>
    <!--
    No lo quiero mostrar ya que en la opción de crear el producto me renvia
    <a class=" text-3xl font-medium" href="{{route('categoria')}}">Categoria</a>

    No lo quiero mostrar para que no se pueda acceder tan fácilmente y sea seguro
    <a class=" text-3xl font-medium" href="{{route('stock')}}">Productos</a>-->

    <a class=" text-3xl font-medium" href="{{route('showStock')}}">Stock</a>
</div>
{{ $slot }}
@livewireScripts
</body>
</html>
