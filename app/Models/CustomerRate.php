<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRate extends Model
{
    use HasFactory;

    public $table = 'customer_rate';

    public $fillable = [
        'customer_id',
        'driver_id',
        'rate',
        'report',
    ];


    ################# Relations ####################

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
