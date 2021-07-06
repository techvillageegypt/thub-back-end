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


    public $table = 'products';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'description',
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


    ###################### Relations #########################


    public function mainProduct()
    {
        return $this->belongsTo(Product::class);
    }
}
