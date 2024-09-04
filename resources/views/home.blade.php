@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="header text-center my-4">
        <h1>PetLove</h1>
    </div>

    <!-- Main Section -->
    <section class="section">
        <h1 class="text-center my-4">Itens para Animais de Estimação</h1>
        <div class="row justify-content-center">
            <!-- Produtos Card -->
            <div class="col-md-4">
                <div class="card">
                    <img src="..\images\produtos.jpeg" alt="Itens para Cachorros" class="card-img-top">
                    <div class="card-body">
                        <h2>Produtos</h2>
                        <p>Encontre os melhores produtos para seu pet, incluindo brinquedos, alimentos e acessórios de qualidade.</p>
                        <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary">Produtos</a>
                    </div>
                </div>
            </div>
            <!-- Pets Card -->
            <div class="col-md-4">
                <div class="card">
                    <img src="..\images\animais.jpg" alt="Itens para Pets" class="card-img-top">
                    <div class="card-body">
                        <h2>Pets</h2>
                        <p>Veja e gerencie os pets cadastrados, incluindo detalhes como nome, peso e imagem.</p>
                        <a href="{{ route('pets.index') }}" class="btn btn-outline-secondary">Pets</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
