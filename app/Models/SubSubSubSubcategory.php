<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSubSubSubcategory extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'main_category_id',
        'category_id',
        'subcategory_id',
        'sub_subcategory_id',
        'sub_sub_subcategory_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'subsubsubsubcategory_id');
    }

    public function subSubSubcategory()
    {
        return $this->belongsTo(SubSubSubcategory::class);
    }
}
