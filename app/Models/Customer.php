<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Customer extends Model
{
    use Notifiable,  SoftDeletes, HasFactory;


    public $table = 'customers';


    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'password',
        'remember_token',
    ];

    protected $fillable = [
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
        'state_id'          => 'nullable|exists:states,id',
        'building_number'   => 'nullable|numeric',
        'floor_number'      => 'nullable|numeric',
        'apartment_number'  => 'nullable|numeric',
    ];


    ########################### Relations #########################

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'customer_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
