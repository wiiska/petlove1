<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItensPedido extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'produto_id', 'qtd'];

    public function product()
    {
        return $this->belongsTo(Produtos::class, 'produto_id');
    }
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
