<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <h3 class="md-3">{{ $titulo }}</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Valor</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Imagem</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produtos as $produto)
            @php
                $imagem = !empty($produto->imagem) ? $produto->imagem : 'C:\laragon\www\petlove1\storage\app\public\sem_imagem.jpg';
                $srcImagem = public_path()."C:\laragon\www\petlove1\storage\app\public\imagem".$imagem;
            @endphp
                <tr>
                    <th scope="row">{{ $produto->id }}</th>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->valor }}</td>
                    <td>{{ $produto->qtd }}</td>
                    <td><img src="{{ $imagem }}" alt="img" style="width: 100px"></td>
                    <td></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Sem registro</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
