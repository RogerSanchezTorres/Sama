<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'subcategory_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'main_category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'sub_subcategory_id');
    }


    public function minorcategories()
    {
        return $this->hasMany(MinorCategory::class);
    }
}
