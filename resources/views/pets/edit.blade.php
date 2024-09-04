@extends('layouts.main')

@section('title', 'Editar Pet')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Editar Pet</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('pets.update', $pet->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Pet</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $pet->nome) }}" required>
                    @if ($errors->has('nome'))
                        <div class="text-danger">{{ $errors->first('nome') }}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="peso" class="form-label">Peso do Pet (kg)</label>
                    <input type="number" step="0.01" class="form-control" id="peso" name="peso" value="{{ old('peso', $pet->peso) }}" required>
                    @if ($errors->has('peso'))
                        <div class="text-danger">{{ $errors->first('peso') }}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="imagem" class="form-label">Imagem do Pet</label>
                    <input type="file" class="form-control" id="imagem" name="imagem">
                    @if ($errors->has('imagem'))
                        <div class="text-danger">{{ $errors->first('imagem') }}</div>
                    @endif
                </div>

                @if ($pet->imagem)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $pet->imagem) }}" alt="Imagem atual do Pet" style="max-width: 200px;">
                        <p class="form-text">Imagem atual</p>
                    </div>
                @endif

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                    <a href="{{ route('pets.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
