<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use Notifiable,  SoftDeletes;


    public $table = 'drivers';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'address',
        'housing_type',
        'house_number',
        'state_id',
        'building_number',
        'apartment_number',
    ];

    public static $rules = [
        'name'              => 'required|string|max:191',
        'address'           => 'nullable|string|max:191',
        'housing_type'      => 'nullable|in:1,2',
        'state_id'          => 'required|exists:states,id',
        'building_number'   => 'nullable|numeric',
        'apartment_number'  => 'nullable|numeric',

    ];


    ########################### Appends #########################

    public $appends = ['total_weight'];

    public function getTotalWeightAttribute()
    {
        return $this->weights()->whereDay('date', Carbon::now()->day)->sum('weight');
    }

    ########################### Relations #########################

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }



    public function weights()
    {
        return $this->hasMany(DriverWeight::class);
    }
}
