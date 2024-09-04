@extends('layouts.main')

@section('title', 'Registro Completo')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Registro Completo</h3>
                    </div>

                    <div class="card-body text-center">
                        <p>Bem-vindo! Seu registro foi concluído com sucesso.</p>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Ir para Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
