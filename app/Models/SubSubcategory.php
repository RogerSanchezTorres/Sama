<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'slug', 'subcategory_id',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
