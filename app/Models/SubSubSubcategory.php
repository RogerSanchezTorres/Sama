<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubSubcategory extends Model
{
    use HasFactory;

    protected $table = 'sub_sub_subcategories';

    protected $fillable = [
        'nombre',
        'slug',
        'main_category_id',
        'category_id',
        'subcategory_id',
        'sub_subcategory_id',
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
        return $this->belongsTo(SubSubcategory::class, 'sub_subcategory_id');
    }
}
