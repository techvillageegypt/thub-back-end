<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Brand
 * @package App\Models
 * @version April 6, 2021, 8:34 am UTC
 *
 * @property string $logo
 */
class Brand extends Model
{
    use SoftDeletes, Translatable, ImageUploaderTrait;


    public $table = 'brands';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'logo'
    ];

    public $translatedAttributes = ['text'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.text'] = 'required|string|max:191';
        }

        $rules['logo'] = 'required|image|mimes:jpeg,jpg,png';

        return $rules;
    }

    ################################# Functions #####################################

    public function setLogoAttribute($file)
    {
        try {
            if ($file) {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 190, 275);

                $this->attributes['logo'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['logo'] = $file;
        }
    }


    ################################### Appends #####################################

    protected $appends = ['logo_original_path', 'logo_thumbnail_path'];

    public function getLogoOriginalPathAttribute()
    {
        return $this->logo ? asset('uploads/images/original/' . $this->logo) : null;
    }

    public function getLogoThumbnailPathAttribute()
    {
        return $this->logo ? asset('uploads/images/thumbnail/' . $this->logo) : null;
    }

    ################################### Relations #####################################

}
