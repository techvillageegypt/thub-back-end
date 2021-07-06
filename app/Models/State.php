<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class State
 * @package App\Models
 * @version June 20, 2021, 1:15 pm UTC
 *
 */
class State extends Model
{
    use SoftDeletes, Translatable;


    public $table = 'states';


    protected $dates = ['deleted_at'];



    public $fillable = ['id'];


    public $translatedAttributes = ['name'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.name'] = 'required|string|max:191';
        }

        return $rules;
    }
}
