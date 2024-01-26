<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $guarded = ["codigo_referencia"];
    public function pedidos(){
        return $this->belongsToMany(Pedido::class)->witPivot("cantidad");
    }

    public function categorias(){
        return $this->belongsToMany(Categoria::class, 'productos_categorias', 'producto_id', 'categoria_id');
    }
}
