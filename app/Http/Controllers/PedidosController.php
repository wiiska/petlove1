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
        $pedido = Pedidos::create([
            'user_id' => Auth::id(),
            'status' => 'Confirmado',
            'total' => $total,
        ]);

        // Atualiza os itens do carrinho com o novo ID de pedido
        ItensPedido::where('pedido_id', $pedidoId)->update(['pedido_id' => $pedido->id]);

        // Limpa a sessão
        session()->forget('pedido_id');

        return redirect()->route('produtos.index')->with('success', 'Pedido finalizado com sucesso!');
    }
}
