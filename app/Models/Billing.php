<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'city',
        'province',
        'postalCode',
        'country',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}