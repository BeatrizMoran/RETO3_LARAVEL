<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users(){
        return $this->belongsToMany(User::class, 'pedidos_usuarios', 'pedido_id', 'usuario_id')->withTimestamps();
    }

    public function productos(){
        return $this->belongsToMany(Producto::class, 'pedidos_productos')->withPivot('cantidad');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
