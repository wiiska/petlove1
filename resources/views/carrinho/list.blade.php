@extends('layouts.main')

@section('title', 'Carrinho de Compras')

@section('content')
    <div class="container mt-5">
        <h3 class="text-center mb-4">Carrinho de Compras</h3>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($itens->isEmpty())
            <p class="text-center">Seu carrinho está vazio.</p>
        @else
            <div class="row">
                @foreach($itens as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/imagens/' . $item->produto->imagem) }}" class="card-img-top" alt="{{ $item->produto->nome }}" style="max-height: 200px;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->produto->nome }}</h5>
                                <p class="card-text">Valor: R$ {{ $item->produto->valor }}</p>
                                <p class="card-text">Quantidade: {{ $item->qtd }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-end">
                <form action="{{ route('carrinho.finalize') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Finalizar Compra</button>
                    <a href="{{ url('/') }}" class="btn btn-primary">Voltar</a>
                </form>
            </div>
        @endif
    </div>
@stop
