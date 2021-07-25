<?php

namespace App\Repositories\AdminPanel;

use App\Models\Color;
use App\Repositories\BaseRepository;

/**
 * Class ColorRepository
 * @package App\Repositories\AdminPanel
 * @version May 20, 2021, 11:26 am UTC
*/

class ColorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'hex'
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
        return Color::class;
    }
}
