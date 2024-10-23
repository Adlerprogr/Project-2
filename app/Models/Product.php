<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'calories',
        'squirrels',
        'fats',
        'carbohydrates',
        'weight',
        'price',
        'image_id',
        'quantity'
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function images()
    {
        return $this->hasOne(Image::class);
    }

    public function userProducts()
    {
        return $this->belongsToMany(UserProduct::class);
    }
}
