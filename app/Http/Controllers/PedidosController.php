<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedidos;
use App\Models\ItensPedido;
use App\Models\Produtos;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{
    public function store(Request $request)
{
    $user = auth()->user();
    $itensPedido = ItensPedido::where('user_id', $user->id)->whereNull('pedido_id')->firstOrFail();

    $pedido = new Pedidos();
    $pedido->user_id = $user->id;
    $pedido->valor_total = $itensPedido->produtos->sum(fn($produto) => $produto->pivot->qtd * $produto->preco);
    $pedido->save();

    // Associa os produtos ao pedido
    foreach ($itensPedido->produtos as $produto) {
        $pedido->produtos()->attach($produto->id, [
            'qtd' => $produto->pivot->qtd,
            'preco_unitario' => $produto->preco,
        ]);
    }

    // Atualiza o carrinho para vincular ao pedido
    $itensPedido->pedido_id = $pedido->id;
    $itensPedido->save();

    return redirect()->route('pedidos.show', $pedido)->with('success', 'Pedido criado com sucesso!');
}

}
