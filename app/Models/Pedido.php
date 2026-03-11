<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'cliente',
        'fecha_pedido',
        'estado'
    ];

    public $timestamps = false;

    public function camisetas(): HasMany
    {
        return $this->hasMany(Camiseta::class, 'pedido_id');
    }
}