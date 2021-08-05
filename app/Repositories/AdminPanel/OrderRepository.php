<?php

namespace App\Repositories\AdminPanel;

use App\Models\Order;
use App\Repositories\BaseRepository;

/**
 * Class OrderRepository
 * @package App\Repositories\AdminPanel
 * @version July 14, 2021, 1:53 pm UTC
 */

class OrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'address',
        'housing_type',
        'house_number',
        'building_number',
        'apartment_number',
        'state_id',
        'status',
        'payment_method',
        'subtotal',
        'total',
        'user_id'
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
        return Order::class;
    }
}
