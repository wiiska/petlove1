@extends('layouts.main')

@section('title', 'Pedido Detalhado')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Pedido #{{ $pedido->id }}</h1>

    <p><strong>Usuário:</strong> {{ $pedido->user->name }}</p>
    <p><strong>Data:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
    
    <h3>Produtos</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedido->produtos as $produto)
            <tr>
                <td>{{ $produto->nome }}</td>
                <td>{{ $produto->pivot->qtd }}</td>
                <td>R$ {{ number_format($produto->pivot->preco_unitario, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($produto->pivot->qtd * $produto->pivot->preco_unitario, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="text-end">Valor Total: R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</h3>
</div>
@endsection
