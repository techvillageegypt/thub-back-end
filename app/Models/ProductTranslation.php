<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductTranslation extends Model
{
    protected $table = 'product_translations';

    protected $fillable = ['title', 'brief', 'description'];

    public $timestamps = false;
}
