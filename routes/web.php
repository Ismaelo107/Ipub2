<?php

use App\Livewire\ComandaComponent;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/stock', 'stock')->name('stock');
Route::get('/comanda/{mesa}', ComandaComponent::class)->name('comanda');
