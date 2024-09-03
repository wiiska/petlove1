<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItensPedido;
use App\Models\Produtos;
use Illuminate\Support\Facades\Auth;

class ItensPedidoController extends Controller
{
    public function index()
    {
        $pedidoId = session('pedido_id');
        
        if (!$pedidoId) {
            return redirect()->route('produtos.index')->with('error', 'Nenhum pedido ativo encontrado.');
        }

        $itens = ItensPedido::where('pedido_id', $pedidoId)->get();

        return view('itensPedido.index', compact('itens'));
    }

    public function finalize(Request $request)
{
    $pedidoId = session('pedido_id');
    
    if (!$pedidoId) {
        return redirect()->route('produtos.index')->with('error', 'Nenhum pedido ativo encontrado.');
    }

    // Calcula o total do pedido
    $total = ItensPedido::where('pedido_id', $pedidoId)
        ->sum(function($item) {
            return $item->qtd * Produtos::find($item->produto_id)->valor;
        });

    // Cria um novo pedido com os itens do carrinho
    $pedido = Pedidos::find($pedidoId);
    $pedido->update([
        'user_id' => Auth::id(),
        'status' => 'Confirmado',
        'total' => $total,
    ]);

    // Limpa a sessão
    session()->forget('pedido_id');

    return redirect()->route('produtos.index')->with('success', 'Pedido finalizado com sucesso!');
}

}
