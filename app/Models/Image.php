<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Image extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'images';

    protected $fillable = [
        'way',
        'name'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
