<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Product
 * @package App\Models
 * @version June 30, 2021, 1:31 pm UTC
 *
 * @property string $title
 * @property string $brief
 * @property string $description
 * @property number $old_price
 * @property number $price
 * @property integer $stock
 * @property integer $status
 */
class ProductItem extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];

    public $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'sale_price',
        'price',
        'stock',
    ];

    protected $casts = [
        'id' => 'integer',
        'sale_price' => 'decimal:2',
        'price' => 'decimal:2',
        'stock' => 'integer',
        'status' => 'integer'
    ];

    public static $rules = [
        'photos'                => 'required|array',
        'photos.*'              => 'required|image|mimes:png,jpg,jpeg',
        'item'                  => 'required|array',
        'item.*.size_id'        => 'required',
        'item.*.color_id'       => 'required',
        'item.*.sale_price'     => 'nullable',
        'item.*.price'          => 'required',
        'item.*.stock'          => 'required',
    ];



    ################################## Appends ###################################

    protected $appends = [
        'is_in_cart',
        // 'is_checked_out',
        'final_price',
    ];


    public function getIsInCartAttribute()
    {
        $user = auth('api')->user();
        if ($user) {
            $cartItems = $user->cart->pluck('item_id')->toArray();
            if (in_array($this->id, $cartItems)) {
                $cartStatus = 1;
            } else {
                $cartStatus = 0;
            }
        } else {
            $cartStatus = 0;
        }
        return $cartStatus;
    }

    // public function getIsCheckedOutAttribute()
    // {
    //     $user = auth('api')->user();
    //     if ($user) {
    //         $Orders = $user->orders;
    //         foreach ($Orders as $Order) {
    //             $OrderItems = $Order->items->pluck('item_id')->toArray();
    //         }
    //         if (in_array($this->id, $OrderItems)) {
    //             $checkoutStatus = 1;
    //         } else {
    //             $checkoutStatus = 0;
    //         }
    //     } else {
    //         $checkoutStatus = 0;
    //     }
    //     return $checkoutStatus;
    // }

    public function getFinalPriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }

    ###################### Relations #########################


    public function mainProduct()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }


    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
