<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverBankAccount extends Model
{
    use HasFactory;

    public $fillable = [
        'driver_id',
        'account_number',
        'ipan',
        'branch_name',
        'branch_address',
        'zip_code',
        'name_in_bank',
    ];


    public static $rules = [
        'account_number' => 'required|string|max:191',
        'ipan' => 'required|string|max:191',
        'branch_name' => 'required|string|max:191',
        'branch_address' => 'required|string|max:191',
        'zip_code' => 'required|string|max:191',
        'name_in_bank' => 'required|string|max:191',
    ];



    ####################################### Relations #######################################

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
