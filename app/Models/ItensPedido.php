<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItensPedido extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'produto_id', 'qtd'];

    public function produtos()
{
    return $this->belongsToMany(Produtos::class)->withPivot('qtd');
}
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
