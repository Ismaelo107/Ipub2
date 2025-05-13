<?php

use App\Livewire\ComandaComponent;
use App\Livewire\EditStockComponent;
use App\Livewire\RemoveStockComponent;
use App\Models\Stock;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/stock', 'stock')->name('stock');
Route::view('/show/stock', 'showStock')->name('showStock');
Route::get('/edit/{productoId}/stock', EditStockComponent::class)->name('editStock');
Route::view('/categoria', 'categoria')->name('categoria');
Route::get('/comanda/{mesa}', ComandaComponent::class)->name('comanda');
