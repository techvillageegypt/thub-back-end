<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class StateTranslation extends Model
{
    protected $table = 'state_translations';

    protected $fillable = ['name'];

    public $timestamps = false;
}
