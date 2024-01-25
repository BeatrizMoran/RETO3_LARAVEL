<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function productos(){
        return $this->belongsToMany(Producto::class)->witPivot("cantidad");
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
