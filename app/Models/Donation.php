<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'status',  // 0 => New, 1 => Picked up, 2 => Delivered, 3 => Not Picked up
        'driver_notes',
        'weight',
    ];

    ############################## Appends ###############################

    protected $appends = ['status_text'];

    public function getStatusTextAttribute()
    {
        switch ($this->attributes['status']) {
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

            default:
                break;
        }
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
