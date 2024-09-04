<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\ItensPedido;
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
    $produto = Produtos::findOrFail($id);

    if ($produto->imagem) {

        $produto = Produtos::findOrFail($id);
        // dd($dado);
        $image_path = public_path('storage/imagens/'.$produto->imagem);

        if(file_exists($image_path)){
            unlink($image_path);
        }

    }
    $produto->delete();

    return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
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

    public function addToCart(Request $request, $produtoId)
    {
        $user = auth()->user();
        
        // Verifica se existe um carrinho ativo para o usuário
        $itensPedido = ItensPedido::where('user_id', $user->id)->first();
    
        // Cria o carrinho caso não exista
        if (!$itensPedido) {
            $itensPedido = new ItensPedido();
            $itensPedido->user_id = $user->id;
            $itensPedido->save();
        }
    
        // Adiciona o produto ao carrinho
        $produto = Produtos::findOrFail($produtoId);
    
        // Verifica se o produto já está no carrinho
        $item = $itensPedido->produtos()->where('produto_id', $produto->id)->first();
        
        if ($item) {
            // Atualiza a quantidade se o produto já estiver no carrinho
            $item->pivot->qtd += $request->input('qtd', 1);
            $item->pivot->save();
        } else {
            // Adiciona um novo item ao carrinho
            $itensPedido->produtos()->attach($produto->id, ['qtd' => $request->input('qtd', 1)]);
        }
    
        return redirect()->route('carrinho.index')->with('success', 'Produto adicionado ao carrinho!');
    }
    
}
