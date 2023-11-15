<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'tipo',
        'nombre_es',
        'precio_es',
        'descripcion',
        'precio_oferta_es',
        'precio_coste',
        'publicado',
        'proveedor',
        'marca',
        'img'
    ];

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'main_category_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
