<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'email',
        'phone',
        'last_name',
        'address',
        'city',
        'comment',
        'entrance',
        'floor',
        'flat',
        'intercom',
        'delivery_date',
        'delivery_time'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
