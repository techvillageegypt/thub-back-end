<?php

namespace App\Repositories\AdminPanel;

use App\Models\Size;
use App\Repositories\BaseRepository;

/**
 * Class SizeRepository
 * @package App\Repositories\AdminPanel
 * @version July 5, 2021, 8:00 am UTC
*/

class SizeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return Size::class;
    }
}
