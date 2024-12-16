<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinorCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'main_category_id',
        'category_id',
        'subcategory_id',
        'subsubcategory_id'
    ];

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function subsubcategory()
    {
        return $this->belongsTo(SubSubcategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
