<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{

    protected $fillable = ['producto_id', 'usuario_id', 'contenido'];
    protected $appends = ['formatted_date'];

    public function producto()
    {
        return $this->belongsTo(Product::class, 'producto_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d/m/Y H:i:s');
    }
}
