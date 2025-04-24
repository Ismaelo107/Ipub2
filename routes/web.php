<?php

use App\Livewire\ComandaComponent;
use App\Models\Stock;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/stock', 'stock')->name('stock');
Route::view('/show/stock','showStock')->name('showStock');
Route::view('/categoria', 'categoria')->name('categoria');
Route::get('/mesa/{mesa}', ComandaComponent::class)->name('comanda');
