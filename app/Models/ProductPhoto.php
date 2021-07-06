<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class ProductPhoto
 * @package App\Models
 * @version June 30, 2021, 1:44 pm UTC
 *
 * @property integer $product_id
 * @property integer $photo
 */
class ProductPhoto extends Model
{
    use SoftDeletes;


    public $table = 'product_photos';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'product_id',
        'photo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'photo' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
