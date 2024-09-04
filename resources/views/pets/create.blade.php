@extends('layouts.main')

@section('title', 'Adicionar Novo Pet')

@section('content')
<div class="container">
    <h1 class="my-4">Adicionar Novo Pet</h1>
    <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
        </div>
        <div class="mb-3">
            <label for="peso" class="form-label">Peso</label>
            <input type="text" class="form-control" id="peso" name="peso" value="{{ old('peso') }}" required>
        </div>
        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem</label>
            <input type="file" class="form-control" id="imagem" name="imagem">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
