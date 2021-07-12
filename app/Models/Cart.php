<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $table = 'user_cart';

    public $fillable = [
        'user_id',
        'item_id',
        'quantity',
    ];

    public $timestamps = false;

    #################################### Relations ##############################

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(ProductItem::class);
    }
}
