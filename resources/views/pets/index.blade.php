@extends('layouts.main')

@section('title', 'Lista de Pets')

@section('content')
<div class="container">
    <h1 class="my-4">Lista de Pets</h1>
    <a href="{{ route('pets.create') }}" class="btn btn-primary mb-3">Adicionar Novo Pet</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Peso</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pets as $pet)
                <tr>
                    <td>{{ $pet->id }}</td>
                    <td>{{ $pet->nome }}</td>
                    <td>{{ $pet->peso }}</td>
                    <td>
                        @if ($pet->imagem)
                            <img src="{{ asset('storage/' . $pet->imagem) }}" alt="{{ $pet->nome }}" width="100">
                        @endif
                    </td>
                    <td>
    
                        <a href="{{ route('pets.edit', $pet) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('pets.destroy', $pet) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
