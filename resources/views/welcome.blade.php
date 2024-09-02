@extends('base')
@section('conteudo')
@section('titulo', 'Página Inícial')

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .header {
            background-color: #6f42c1; /* Cor roxa principal */
            color: white;
            padding: 15px;
            text-align: center;
        }
        .header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .header a:hover {
            text-decoration: underline;
        }
        .card-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            padding: 20px;
        }
        .card {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
        }
        .card img {
            max-width: 100%;
            border-radius: 8px;
        }
        .card h2 {
            margin: 10px 0;
            font-size: 1.5em;
        }
        .card p {
            font-size: 1em;
            color: #555;
        }
        .cart-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #6f42c1; /* Cor roxa principal */
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        .cart-button:hover {
            background-color: #5a2e91;
            transform: scale(1.1);
        }
        .nav-item {
            margin-right: 15px;
        }
    </style>
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="container-fluid">
                <!-- Header -->
                <div class="header">
                    <h1>PetLove</h1>
                    <nav class="navbar navbar-expand-lg navbar-dark">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="sobre.html">Entrar/Cadastrar</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Main Section -->
                <section class="section">
                    <h1 class="text-center my-4">Itens para Animais de Estimação</h1>
                    <div class="card-container">
                        <div class="card">
                            <img src="https://via.placeholder.com/300x200?text=Itens+para+Cachorros" alt="Itens para Cachorros">
                            <div class="card-body">
                                <h2>Produtos</h2>
                                <p>Encontre os melhores produtos para seu pet, incluindo brinquedos, alimentos e acessórios de qualidade.</p>
                                <a href="{{url("produtos")}}" class="btn btn-outline-secondary">Produtos</a><br>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Cart Button -->
                <a href="{{url("carrinho")}}" class="cart-button">
                    🛒
                </a>
            </div>

            <!-- Bootstrap JS and dependencies -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
