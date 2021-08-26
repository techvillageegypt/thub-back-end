<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'customer_donations';

    protected $fillable = [
        'customer_id',
        'driver_id',
        'code',
        'name',
        'address',
        'lat',
        'long',
        'housing_type',
        'house_number',
        'state_id',
        'building_number',
        'apartment_number',
        'pickup_date',
        'status',  // 0 => New, 1 => Picked up, 2 => Delivered, 3 => Not Picked up, 4 => Reschedule, 5 => InProgress
        'driver_notes',
        'customer_notes',
        'bags',
        'plastic_bags',
        'cartons',
        'cars',
        'feedback',
        'feedback_notes',
    ];

    ############################## Appends ###############################

    protected $appends = ['status_text'];

    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case 0:
                return 'New';
                break;
            case 1:
                return 'Picked up';
                break;
            case 2:
                return 'Delivered';
                break;
            case 3:
                return 'Not Picked up';
                break;
            case 4:
                return 'Reschedule';
                break;
            case 5:
                return 'InProgress';
                break;

            default:
                break;
        }
    }



    public function setPickupDateAttribute($value)
    {
        $this->attributes['pickup_date'] = (new Carbon($value))->format('y-m-d G:i:s');
    }



    ############################### Relations ##################################

    public function photos()
    {
        return $this->hasMany(DonationPhoto::class);
    }

    public function types()
    {
        return $this->hasMany(TypeOfDonation::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
