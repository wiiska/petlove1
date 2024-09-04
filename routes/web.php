<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ItensPedidoController;
use App\Http\Controllers\PetController;
use App\Models\ItensPedido;

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rotas públicas (sem autenticação)
Route::get('/produtos/report', [ProdutosController::class, 'report'])->name('produtos.report');
Route::get('/produtos/{id}/add-to-cart', [ProdutosController::class, 'addToCart'])->name('produtos.addToCart');

Route::get('/Pedidos/report', [PedidosController::class, 'report'])->name('Pedidos.report');

// routes/web.php
// web.php
Route::get('/carrinho', [ItensPedidoController::class, 'index'])->name('carrinho.index');
Route::post('/carrinho/finalizar', [ItensPedidoController::class, 'finalize'])->name('carrinho.finalize');

// Rotas protegidas (com autenticação)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('Pedidos', PedidosController::class);
    Route::post('/Pedidos/search', [PedidosController::class, 'search'])->name('Pedidos.search');

    Route::resource('produtos', ProdutosController::class); // Corrigido para 'produtos'
    Route::post('/produtos/search', [ProdutosController::class, 'search'])->name('produtos.search');
        
    Route::resource('pets', PetController::class);

    
});

require __DIR__ . '/auth.php';
