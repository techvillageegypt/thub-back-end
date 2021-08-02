<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OptionTranslation extends Model
{
    protected $fillable = ['welcome_message'];

    public $timestamps = false;
}
