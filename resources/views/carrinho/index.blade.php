@extends('layouts.main')

@section('title', 'Carrinho de Compras')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Seu Carrinho</h1>
    
    @if ($itensPedido->produtos->isEmpty())
        <p class="text-center">Seu carrinho está vazio.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itensPedido->produtos as $produto)
                <tr>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->pivot->qtd }}</td>
                    <td>{{ $produto->preco }}</td>
                    <td>{{ $produto->pivot->qtd * $produto->preco }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <h3 class="text-end">Total: R$ {{ $itensPedido->produtos->sum(fn($produto) => $produto->pivot->qtd * $produto->preco) }}</h3>
        
        <a href="{{ route('pedidos.create') }}" class="btn btn-primary mt-3">Finalizar Pedido</a>
    @endif
</div>
@endsection
