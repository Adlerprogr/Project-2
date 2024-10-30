<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'users';

    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name' ,
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function userProducts()
    {
        return $this->belongsToMany(UserProduct::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
