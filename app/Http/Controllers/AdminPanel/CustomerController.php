<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateCustomerRequest;
use App\Http\Requests\AdminPanel\UpdateCustomerRequest;
use App\Repositories\AdminPanel\CustomerRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Customer;
use Illuminate\Http\Request;
use Flash;
use Response;

class CustomerController extends AppBaseController
{
    /** @var  CustomerRepository */
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepository = $customerRepo;
    }

    /**
     * Display a listing of the Customer.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $customers = $this->customerRepository->all();

        return view('adminPanel.customers.index')
            ->with('customers', $customers);
    }

    /**
     * Display the specified Customer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $customer = $this->customerRepository->find($id);

        if (empty($customer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/customers.singular')]));

            return redirect(route('adminPanel.customers.index'));
        }

        return view('adminPanel.customers.show')->with('customer', $customer);
    }
}
