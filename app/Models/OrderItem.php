<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderItem extends Model
{
    use SoftDeletes;


    public $table = 'order_items';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'order_id',
        'item_id',
        'title',
        'color',
        'size',
        'price',
        'quantity',
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];
}
