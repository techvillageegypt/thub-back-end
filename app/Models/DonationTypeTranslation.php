<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DonationTypeTranslation extends Model
{
    protected $table = 'donation_type_translations';

    protected $fillable = ['name'];

    public $timestamps = false;
}
