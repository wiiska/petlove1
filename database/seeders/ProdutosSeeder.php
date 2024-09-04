<?php

namespace Database\Seeders;

use App\Models\Produtos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produtos::create([
            'nome' => "Ração 5Kg",
            'valor' => "25",
            'imagem' => "public\imagens\IUJeTujwz6UDCy9VQQkPnlYiH8dTFpELDwuraiD8.jpg",
            'qtd' => "43",]
        );
    }
}
