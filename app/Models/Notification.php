<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

class Notification extends Model
{
    use SoftDeletes, Translatable;


    public $table = 'notifications';


    protected $dates = ['deleted_at'];

    public $translatedAttributes =  ['text'];

    public $fillable = [
        'user_id',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'brief' => 'string',
        'description' => 'string',
        'btn_to' => 'string',
        'photo' => 'string',
        'type' => 'string'
    ];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.text'] = 'required|string|min:3|max:191';
        }

        $rules['type'] = 'required|in:1,2,3';

        return $rules;
    }



    ######################### Relations ##########################

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
