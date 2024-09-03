<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\ItensPedido;
use App\Models\Pedidos; // Corrigido o namespace
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\Storage;

class ProdutosController extends Controller
{
    private $pagination = 5;

    public function index()
    {
        $dado = Produtos::paginate($this->pagination);
        return view("produtos.produto_list", ["dado" => $dado]);
    }

    public function create()
    {
        return view("produtos.createpd");
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:60',
            'valor' => 'required',
            'qtd' => 'required',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $data = $request->all();
    
        if ($request->hasFile('imagem')) {
            $imagePath = $request->file('imagem')->store('public/imagens');
            $data['imagem'] = basename($imagePath);
        }
    
        Produtos::create($data);
    
        return redirect()->route('produtos.index');
    }

    public function edit(string $id)
    {
        $dado = Produtos::findOrFail($id);
        return view("produtos.createpd", ['dado' => $dado]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|max:60',
            'valor' => 'required|max:16',
            'qtd' => 'required',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $data = $request->all();
        $produto = Produtos::findOrFail($id);
    
        if ($request->hasFile('imagem')) {
            // Delete old image if exists
            if ($produto->imagem) {
                Storage::delete('public/imagens/' . $produto->imagem);
            }
            $imagePath = $request->file('imagem')->store('public/imagens');
            $data['imagem'] = basename($imagePath);
        }
    
        $produto->update($data);
    
        return redirect()->route('produtos.index');
    }

    public function destroy($id)
    {
        $dado = Produtos::findOrFail($id);
        $dado->delete();

        return redirect('produto');
    }

    public function search(Request $request)
    {
        if (!empty($request->nome)) {
            $dados = Produtos::where(
                "nome",
                "like",
                "%" . $request->nome . "%"
            )->get();
        } else {
            $dados = Produtos::all();
        }

        return view("produtos.produto_list", ["dado" => $dados]);
    }

    public function report()
    {
        $produtos = Produtos::All();

        $data = [
            'titulo' => 'Relatório de Produtos',
            'produtos' => $produtos,
        ];

        $pdf = PDF::loadView('produtos.report', $data);

        return $pdf->stream();
    }

    public function addToCart($id)
{
    $produto = Produtos::findOrFail($id);

    // Verifique se o pedido atual está na sessão

    // Verifique se o item já está no carrinho
    $itemPedido = ItensPedido::where('produto_id', $id)
        ->where('pedido_id', $pedidoId)
        ->first();

    if ($itemPedido) {
        // Se o produto já estiver no carrinho, aumente a quantidade
        $itemPedido->qtd += 1;
    } else {
        // Se não, adicione um novo item ao carrinho
        $itemPedido = new ItensPedido();
        $itemPedido->produto_id = $produto->id;
        $itemPedido->pedido_id = $pedidoId;
        $itemPedido->qtd = 1;
    }

    $itemPedido->save();

    // Redireciona para a página do carrinho
    return redirect()->route('carrinho.index')->with('success', 'Produto adicionado ao carrinho!');
}
}
