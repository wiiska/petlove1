<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produtos;
use PDF;

class ProdutosController extends Controller
{
    private $pagination = 5;
    public function index()
    {
        //app/http/Controller
        $dado = Produtos::paginate($this->pagination);

        //dd($dado);

        return view("produtos.produto_list", ["dado" => $dado]);
    }

    /**
     * Show the produto_list for creating a new resource.
     */
    public function create()
    {
        $departamentos =  Departamento::all();
        return view("produtos.createpd", ['departamentos' => $departamentos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => "required|max:60",
            'departamento_id' => "required",
            'valor' => "required",
            'qtd' => "required"
        ], [
            'nome.required' => "O :attribute é obrigatório",
            'nome.max' => "Só é permitido 60 caracteres",
            'departamento_id.required' => "O :attribute é obrigatório",
            'valor.required' => "O :attribute é obrigatório",
            'qtd.required' => "O :attribute é obrigatório",

        ]);

        $data = $request->all();
        /*
        $produto = new Produto;

        $produto->nome = $request->nome;
        $produto->categoria_id = $request->categoria_id;
        $produto->valor = $request->valor;
        $produto->qtd = $request->qtd;

        $produto->save();
        */
        Produtos::create($data);

        return redirect('produto');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the produto_list for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dado = Produtos::findOrFail($id);

        $departamentos = Departamento::all();

        return view("produtos.createpd", [
            'dado' => $dado,
            'departamentos' => $departamentos
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //app/http/Controller

        $request->validate([
            'nome' => "required|max:60",
            'departamento_id' => "required",
            'valor' => "required|max:16",
            'qtd' => "required"
        ], [
            'nome.required' => "O :attribute é obrigatório",
            'nome.max' => "Só é permitido 60 caracteres",
            'departamento_id.required' => "O :attribute é obrigatório",
            'valor.required' => "O :attribute é obrigatório",
            'valor.max' => "Só é permitido 16 caracteres",
            'qtd.required' => "O :attribute é obrigatório",

        ]);

        $data = $request->all();

        Produtos::updateOrCreate(
            ['id' => $request->id],
            $data
        );

        return redirect('produto');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dado = Produtos::findOrFail($id);
        // dd($dado);
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
        }  else {
            $dados = Produtos::all();
        }
        // dd($dados);

        return view("produtos.produto_list", ["dado" => $dados]);
    }

    public function report()
    {
        $produtos = Produtos::All();

        $data = [
            'titulo' => 'Relatório de Produtos',
            'produtos'=> $produtos,
        ];

        $pdf = PDF::loadView('produtos.report', $data);

        return $pdf->stream();
    }
}
