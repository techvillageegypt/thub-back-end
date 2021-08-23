<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
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
    use SoftDeletes, Translatable, ImageUploaderTrait;


    public $table = 'categories';


    protected $dates = ['deleted_at'];

    public $fillable = ['parent_id', 'status', 'icon'];
    public $translatedAttributes = ['name', 'brief'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'text' => 'string',
        'icon' => 'string',
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

        $rules['icon']      = 'required';
        $rules['parent_id'] = 'nullable';
        $rules['status']    = 'required|in:0,1';

        return $rules;
    }



    ########################### Appends #############################


    protected $appends = [
        'icon_original_path',
        'icon_thumbnail_path',
    ];

    // icon
    public function setIconAttribute($file)
    {
        try {
            if ($file) {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 200, 200);

                $this->attributes['icon'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['icon'] = $file;
        }
    }

    public function getIconOriginalPathAttribute()
    {
        return $this->icon ? asset('uploads/images/original/' . $this->icon) : null;
    }

    public function getIconThumbnailPathAttribute()
    {
        return $this->icon ? asset('uploads/images/thumbnail/' . $this->icon) : null;
    }
    // icon



    ########################### Scopes #############################


    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    public function scopeParent($query)
    {
        return $query->where('parent_id', null);
    }

    public function scopeChild($query)
    {
        return $query->where('parent_id', '!=', null);
    }

    ########################### Relations #############################

    public function products()
    {
        return $this->hasMany(Product::class);
    }


    public function main()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
