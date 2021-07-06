<?php

namespace App\Repositories\AdminPanel;

use App\Models\ProductPhoto;
use App\Repositories\BaseRepository;

/**
 * Class ProductPhotoRepository
 * @package App\Repositories\AdminPanel
 * @version June 30, 2021, 1:44 pm UTC
*/

class ProductPhotoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'photo'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProductPhoto::class;
    }
}
