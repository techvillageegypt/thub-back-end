<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ColorTranslation extends Model
{
    protected $table = 'color_translations';

    protected $fillable = ['name'];

    public $timestamps = false;
}
