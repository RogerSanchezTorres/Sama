<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'main_category_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($category) {
            $category->slug = Str::slug($category->nombre);
        });
    }

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
