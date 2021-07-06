<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
        'floor_number',
        'apartment_number',
    ];

    public static $rules = [
        'name'              => 'required|string|max:191',
        'address'           => 'nullable|string|max:191',
        'housing_type'      => 'nullable|in:1,2',
        'state_id'          => 'required|exists:states,id',
        'building_number'   => 'nullable|numeric',
        'floor_number'      => 'nullable|numeric',
        'apartment_number'  => 'nullable|numeric',

    ];


    ########################### Relations #########################

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
}
