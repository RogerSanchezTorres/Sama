<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'nombre', 'slug', 'category_id', 'main_category_id',
        'parent_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'main_category_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'subcategory_product');
    }

    public function parent()
    {
        return $this->belongsTo(SubCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(SubCategory::class, 'parent_id');
    }

    public function subsubcategories()
    {
        return $this->hasMany(SubSubcategory::class);
    }
}
