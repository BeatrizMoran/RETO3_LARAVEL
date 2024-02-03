<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cliente extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = ['codigo_cliente', 'nombre', 'email', 'direccion', 'telefono'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
