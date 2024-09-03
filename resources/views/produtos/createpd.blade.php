@extends('layouts.main')

@section('title', 'FastNet')

@section('content')
    @php
        $route = !empty($dado->id) ? route('produtos.update', $dado->id) : route('produtos.store');
    @endphp

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="background-color: #4B0082; color: #FFFFFF;">
                    <div class="card-header text-center">
                        <h3>Formulário de Produto</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ $route }}" method="post" enctype="multipart/form-data">
                            @csrf

                            @if (!empty($dado->id))
                                @method('put')
                            @endif

                            <input type="hidden" name="id" value="{{ $dado->id ?? '' }}">

                            <div class="form-group mb-3">
                                <label><b>Descrição do Produto:</b></label>
                                <input type="text" name="nome" class="form-control"
                                    value="{{ old('nome', $dado->nome ?? '') }}">
                            </div>

                            <div class="form-group mb-3">
                                <label><b>Valor do Produto (R$):</b></label>
                                <input type="text" name="valor" class="form-control"
                                    value="{{ old('valor', $dado->valor ?? '') }}">
                            </div>

                            <div class="form-group mb-3">
                                <label><b>Quantidade:</b></label>
                                <input type="text" name="qtd" class="form-control"
                                    value="{{ old('qtd', $dado->qtd ?? '') }}">
                            </div>

                            <div class="form-group mb-3">
                                <label><b>Imagem do Produto:</b></label>
                                <input type="file" name="imagem" class="form-control" id="imagem-input">
                                @if (!empty($dado->imagem))
                                    <div class="mt-3">
                                        <img src="{{ asset('storage/imagens/' . $dado->imagem) }}" alt="Imagem do Produto" class="img-fluid" style="max-height: 200px;">
                                    </div>
                                @else
                                    <img id="imagem-preview" src="#" alt="Pré-visualização da Imagem" class="img-fluid mt-3" style="display: none; max-height: 200px;">
                                @endif
                            </div>

                            <div class="form-group text-end">
                                <button type="submit" class="btn" style="background-color: #90EE90; color: #4B0082;">Salvar</button>
                                <a href="{{ route('produtos.index') }}" class="btn btn-primary">Voltar</a>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('imagem-input').onchange = function (evt) {
            const [file] = evt.target.files;
            if (file) {
                const preview = document.getElementById('imagem-preview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        }
    </script>
@stop
