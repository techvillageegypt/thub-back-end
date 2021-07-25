<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BrandTranslation extends Model
{
    protected $table = 'brand_translations';

    protected $fillable = ['text'];

    public $timestamps = false;
}
