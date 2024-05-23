<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'main_category_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    
}
