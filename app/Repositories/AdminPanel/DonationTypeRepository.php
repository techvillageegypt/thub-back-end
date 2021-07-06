<?php

namespace App\Repositories\AdminPanel;

use App\Models\DonationType;
use App\Repositories\BaseRepository;

/**
 * Class DonationTypeRepository
 * @package App\Repositories\AdminPanel
 * @version June 23, 2021, 8:59 am UTC
*/

class DonationTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'icon'
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
        return DonationType::class;
    }
}
