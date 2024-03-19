<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $dispatchesEvents = [
        'created' => Registered::class,
    ];

    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'phoneNumber',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function billing()
    {
        return $this->hasOne(Billing::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
