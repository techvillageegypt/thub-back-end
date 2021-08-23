<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'userable_id',
        'userable_type',
        'type',
        'status',
        'verify_code',
        'balance',
        'device_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static $rules = [
        'name'              => 'required|string|max:191',
        'phone'             => 'required|string|max:191|uniqe:users,phone',
        'address'           => 'nullable|string|max:191',
        'email'             => 'nullable|email|max:191|unique:customers',
        'housing_type'      => 'nullable|in:1,2',
        'state_id'          => 'nullable',
        'building_number'   => 'nullable',
        'apartment_number'  => 'nullable',
        'status'            => 'nullable',
        'verify_code'       => 'nullable',
        'balance'           => 'nullable',
    ];


    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    ####################### Relations #########################

    public function userable()
    {
        return $this->morphTo();
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
