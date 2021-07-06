<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Category
 * @package App\Models
 * @version June 14, 2021, 8:14 am UTC
 *
 * @property integer $service_id
 * @property string $text
 * @property string $brief
 * @property integer $status
 */
class Category extends Model
{
    use SoftDeletes, Translatable;


    public $table = 'categories';


    protected $dates = ['deleted_at'];

    public $translatedAttributes = ['name', 'brief'];

    public $fillable = ['parent_id', 'status',];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'text' => 'string',
        'brief' => 'string',
        'status' => 'integer'
    ];


    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.name']  = 'required|string|max:191';
            $rules[$language . '.brief'] = 'nullable|string|max:191';
        }

        $rules['parent_id'] = 'nullable';
        $rules['status'] = 'required|in:0,1';

        return $rules;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }
}
