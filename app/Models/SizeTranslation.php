<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SizeTranslation extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;
}
