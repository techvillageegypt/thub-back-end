<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DriverWeight extends Model
{
    use HasFactory;

    protected $table = 'driver_weight';

    public $timestamps = false;

    protected $fillable = [
        'driver_id',
        'date',
        'weight',
    ];


    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
}
