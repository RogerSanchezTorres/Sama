<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_name', 'total', 'status'];

    // Definir la relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}