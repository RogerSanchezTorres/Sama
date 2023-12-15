<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'tipo',
        'id',
        'category_id',
        'main_category_id',
        'id_interno',
        'proveedor',
        'referencia',
        'marca',
        'codigo_barras',
        'stock',
        'nombre_es',
        'precio_es',
        'descripcion',
        'precio_oferta_es',
        'precio_flash_es',
        'precio_flash_fecha_fin_es',
        'precio_coste',
        'publicado',
        'padre',
        'ubicacion',
        'unidades_compra_proveedor',
        'fecha_proxima_entrada_stock',
        'nombre_completo',
        'img',
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
