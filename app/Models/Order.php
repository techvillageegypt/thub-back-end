<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Lang;

/**
 * Class Order
 * @package App\Models
 * @version July 14, 2021, 1:53 pm UTC
 *
 * @property string $name
 * @property string $address
 * @property integer $housing_type
 * @property integer $house_number
 * @property integer $building_number
 * @property integer $apartment_number
 * @property integer $state_id
 * @property integer $status
 * @property integer $payment_method
 * @property integer $subtotal
 * @property integer $total
 * @property integer $user_id
 */
class Order extends Model
{
    use SoftDeletes;


    public $table = 'orders';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'phone',
        'address',
        'housing_type',
        'house_number',
        'building_number',
        'apartment_number',
        'state',
        'status',
        'payment_method',
        'subtotal',
        'total',
        'user_id',
        'driver_id',
        'driver_notes',
        'state_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'address' => 'string',
        'housing_type' => 'integer',
        'house_number' => 'integer',
        'building_number' => 'integer',
        'apartment_number' => 'integer',
        'state' => 'string',
        // 'status' => 'integer',
        'payment_method' => 'integer',
        'subtotal' => 'integer',
        'total' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];


    ############################## Appends ###############################

    protected $appends = ['status_text'];

    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case 0:
                return 'New';
                break;
            case 1:
                return 'Delivered';
                break;
            case 2:
                return 'Not Delivered';
                break;

            default:
                break;
        }
    }

    ############################## Filters ###############################

    public function getPaymentMethodAttribute()
    {
        return $this->attributes['payment_method'] == 1 ? 'Cash On Delevery' : 'Online';
    }



    ############################## Relations ###############################

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
