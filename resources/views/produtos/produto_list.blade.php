@extends('layouts.main')

@section('title', 'FastNet')

@section('content')

    <div class="container">
        <div class="row">
            <h4 class="col-12 p-3 text-center">
                <span class="p-2 bg-info bg-opacity-10 border rounded-start border-info rounded-end" style="color: #4B0082;">
                    <b>Listagem de Produtos</b>
                </span>
            </h4>

            <form action="{{ route('produtos.search') }}" method="post" class="d-flex justify-content-center mb-4">
                @csrf
                <div class="col-md-4">
                    <input type="text" name="nome" class="form-control" placeholder="Digite sua pesquisa">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-warning mx-2">
                        <i class="fa-solid fa-magnifying-glass"></i> Buscar
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('produtos/create') }}" class="btn btn-success">
                        <i class="fa-solid fa-plus"></i> Novo
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('produtos/report') }}" class="btn btn-danger">
                        <i class="fa-solid fa-file-pdf"></i> PDF
                    </a>
                </div>
            </form>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($dado as $item)
                    <div class="col">
                        <div class="card h-100">
                            @if (!empty($item->imagem))
                                <img src="{{ asset('storage/imagens/' . $item->imagem) }}" class="card-img-top" alt="{{ $item->nome }}" style="max-height: 200px; object-fit: cover;">
                            @else
                                <img src="{{ asset('img/default-image.png') }}" class="card-img-top" alt="Imagem padrão" style="max-height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nome }}</h5>
                                <p class="card-text">Valor: R$ {{ $item->valor }}</p>
                                <p class="card-text">Quantidade: {{ $item->qtd }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('produtos.addToCart', $item->id) }}" class="btn btn-secondary">Adicionar ao Carrinho</a>
                                <a href="{{ route('produtos.edit', $item->id) }}" class="btn btn-primary" title="Editar"><i class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('produtos.destroy', $item->id) }}" method="post" style="display:inline;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" title="Deletar"
                                        onclick="return confirm('Deseja realmente deletar esse registro?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $dado->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@stop
