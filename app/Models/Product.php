<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Product
 * @package App\Models
 * @version June 30, 2021, 1:31 pm UTC
 *
 * @property string $title
 * @property string $brief
 * @property string $description
 * @property number $old_price
 * @property number $price
 * @property integer $stock
 * @property integer $status
 */
class Product extends Model
{
    use SoftDeletes, Translatable;


    public $table = 'products';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'category_id',
        'title',
        'brief',
        'description',
        // 'old_price',
        // 'price',
        // 'stock',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'id' => 'integer',
    //     'title' => 'string',
    //     'brief' => 'string',
    //     'description' => 'string',
    //     'old_price' => 'decimal:2',
    //     'price' => 'decimal:2',
    //     'stock' => 'integer',
    //     'status' => 'integer'
    // ];

    public $translatedAttributes = ['title', 'brief', 'description'];

    public static function rules()
    {


        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.title']        = 'required|string|max:191';
            $rules[$language . '.brief']        = 'required|string|max:191';
            $rules[$language . '.description']  = 'required|string|max:191';
        }

        // $rules['sale_price'] = 'nullable|string|max:191';
        // $rules['price']      = 'required|numeric';
        // $rules['stock']      = 'required|numeric';
        $rules['category_id']     = 'required';
        $rules['status']          = 'required|numeric|in:0,1';

        $rules['photos']                = 'required|array';
        $rules['photos.*']             = 'required|image|mimes:png,jpg,jpeg';
        $rules['item']                 = 'required|array';
        $rules['item.*.size_id']       = 'required';
        $rules['item.*.color_id']      = 'required';
        $rules['item.*.sale_price']    = 'nullable';
        $rules['item.*.price']          = 'required';
        $rules['item.*.stock']          = 'required';

        return $rules;
    }



    ################################## Appends ###################################

    protected $appends = [
        'rating_avg'
    ];

    public function getRatingAvgAttribute()
    {
        return $this->rates()->avg('rate');
    }


    ###################### Relations ######################

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function items()
    {
        return $this->hasMany(ProductItem::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function rates()
    {
        return $this->hasMany(ProductRate::class);
    }



    ###################### Scopes ######################

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
