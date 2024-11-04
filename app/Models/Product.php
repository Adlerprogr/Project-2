<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'products';

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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function userProducts(): BelongsToMany
    {
        return $this->belongsToMany(UserProduct::class);
    }
}
