<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Image extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'images';

    protected $fillable = [
        'way',
        'name'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
