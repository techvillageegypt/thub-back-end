<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Color
 * @package App\Models
 * @version May 20, 2021, 11:26 am UTC
 *
 * @property string $name
 * @property string $hex
 */
class Color extends Model
{
    use SoftDeletes, Translatable;


    public $table = 'colors';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'hex'
    ];


    public $translatedAttributes = ['name'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.name'] = 'required|string|max:191';
        }

        $rules['hex'] = 'required|string|max:191';

        return $rules;
    }
}
