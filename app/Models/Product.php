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
        'subcategory_id',
        'sub_subcategory_id',
        'minor_category_id',
        'id_interno',
        'proveedor',
        'referencia',
        'marca',
        'codigo_barras',
        'stock',
        'nombre_es',
        'precio_es',
        'descripcion',
        'detalles',
        'detalles_lista',
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

    protected $casts = [
        'detalles_lista' => 'array',
    ];

    public function getImagesAttribute()
    {
        // Si img es un JSON que contiene un array de URLs de imágenes
        return json_decode($this->img, true) ?? [];

        // Si img es una cadena separada por comas, descomenta la siguiente línea y comenta la anterior
        // return explode(',', $this->img);
    }

    // app/Models/Product.php

    public function getImgAttribute($value)
    {
        // Si ya es array (accedido desde atributo cast), intenta extraer
        if (is_array($value)) {
            return $value[0] ?? null;
        }

        // Si es string y empieza con [, intenta decodificar como JSON
        if (is_string($value) && str_starts_with($value, '[')) {
            $decoded = json_decode($value, true);
            return is_array($decoded) && isset($decoded[0]) ? $decoded[0] : null;
        }

        // En caso contrario, devolver tal cual
        return $value;
    }


    public function getDetallesListaAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    public function detailsList()
    {
        return $this->detalles_lista ?? [];
    }

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'main_category_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function subsubcategory()
    {
        return $this->belongsTo(SubSubcategory::class, 'sub_subcategory_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }

    public function minorCategory()
    {
        return $this->belongsTo(MinorCategory::class, 'minor_category_id');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function apartado()
    {
        return $this->belongsTo(Apartado::class);
    }
}
