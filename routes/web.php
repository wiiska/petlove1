<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ItensCarrinhoController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\PromocaoController;

/*
Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/Pedidos/report',
    [PedidosController::class, "report"])->name('Pedidos.report');
    Route::resource('Pedidos', PedidosController::class);
    Route::post('/Pedidos/search', [PedidosController::class, "search"])->name('Pedidos.search');

    Route::get('/produtos/report',
    [ProdutosController::class, "report"])->name('produtos.report');
    Route::resource('Produtos', ProdutosController::class);
    Route::post('/produtos/search', [ProdutosController::class, "search"])->name('produtos.search');

    Route::resource('ItensCarrinho', ItensCarrinhoController::class);
    Route::post('/ItensCarrinho/search', [ItensCarrinhoController::class, "search"])->name('ItensCarrinho.search');

    Route::post('/pessoa/search', [PessoaController::class, "search"])->name('pessoa.search');
    Route::get(
        '/pessoa/chart/',
        [PessoaController::class, "chart"]
    )->name('pessoa.chart');
    Route::get(
        '/pessoa/report/',
        [PessoaController::class, "report"]
    )->name('pessoa.report');
    Route::resource('pessoa', PessoaController::class);

    Route::post('/promocao/search', [PromocaoController::class, "search"])->name('promocao.search');
    Route::get(
        '/promocao/chart/',
        [PromocaoController::class, "chart"]
    )->name('promocao.chart');
    Route::get(
        '/promocao/report/',
        [PromocaoController::class, "report"]
    )->name('promocao.report');
    Route::resource('promocao', PromocaoController::class);
});

require __DIR__ . '/auth.php';
