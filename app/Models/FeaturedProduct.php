<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;
use App\Models\Apartado;

class FeaturedProduct extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'apartado_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function apartado()
    {
        return $this->belongsTo(Apartado::class);
    }
}
