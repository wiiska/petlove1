<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'total'];

    public function itens()
    {
        return $this->hasMany(ItensPedido::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
