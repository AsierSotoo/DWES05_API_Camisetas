<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Camiseta extends Model
{
    protected $table = 'camisetas';

    protected $fillable = [
        'equipo',
        'temporada',
        'talla',
        'precio_compra',
        'precio_venta',
        'estado',
        'fecha_alta',
        'pedido_id'
    ];

    public $timestamps = false;

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }
}