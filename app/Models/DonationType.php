<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class DonationType
 * @package App\Models
 * @version June 23, 2021, 8:59 am UTC
 *
 * @property string $name
 * @property string $icon
 */
class DonationType extends Model
{
    use SoftDeletes, Translatable, ImageUploaderTrait;


    public $table = 'donation_types';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'icon'
    ];



    public $translatedAttributes = ['name'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.name'] = 'required|string|max:191';
        }

        $rules['icon'] = 'required|image|mimes:jpeg,jpg,png';

        return $rules;
    }


    ############################ Appends #############################

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
}
