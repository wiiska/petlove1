<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;

    // Permitir mass assignment apenas para os campos especificados
    protected $fillable = [
        'nome',
        'valor',
        'qtd',
        'imagem', // Se você estiver salvando o nome da imagem no banco
    ];

    public function itensPedidos()
{
    return $this->belongsToMany(ItensPedido::class)->withPivot('qtd');
}
}
