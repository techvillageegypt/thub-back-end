<?php

namespace App\Http\Controllers\AdminPanel;

use Flash;
use Response;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AdminPanel\OrderRepository;
use App\Http\Requests\AdminPanel\CreateOrderRequest;
use App\Http\Requests\AdminPanel\UpdateOrderRequest;

class OrderController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    /**
     * Display a listing of the Order.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $orders = $this->orderRepository->all();

        return view('adminPanel.orders.index')
            ->with('orders', $orders);
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.orders.create');
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();

        $order = $this->orderRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/orders.singular')]));

        return redirect(route('adminPanel.orders.index'));
    }

    /**
     * Display the specified Order.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orders.singular')]));

            return redirect(route('adminPanel.orders.index'));
        }

        $drivers = Driver::where('state_id', $order->state_id)->get()->pluck('name', 'id');

        return view('adminPanel.orders.show', compact('order', 'drivers'));
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orders.singular')]));

            return redirect(route('adminPanel.orders.index'));
        }

        return view('adminPanel.orders.edit')->with('order', $order);
    }

    /**
     * Update the specified Order in storage.
     *
     * @param int $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRequest $request)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orders.singular')]));

            return redirect(route('adminPanel.orders.index'));
        }

        $order = $this->orderRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/orders.singular')]));

        return redirect(route('adminPanel.orders.index'));
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orders.singular')]));

            return redirect(route('adminPanel.orders.index'));
        }

        $this->orderRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/orders.singular')]));

        return redirect(route('adminPanel.orders.index'));
    }


    public function delevered(Order $order)
    {
        $order->update(['status' => 2]);
        Flash::success('Order Status Changed Successfuly');
        return back();
    }



    public function assign_driver(Order $order)
    {
        $order->update(['driver_id' => request('driver_id')]);

        Flash::success('The Shop Order Assigned Successfuly');

        return back();
    }


    public function dateFilter()
    {

        $fromDate = (new Carbon(request('order_from')))->format('y-m-d G:i:s');
        $toDate = (new Carbon(request('order_to')))->format('y-m-d G:i:s');

        $ordersQuery = Order::query();
        if (request()->filled('order_from')) {
            $ordersQuery->whereBetween('created_at', [$fromDate, $toDate]);
        }
        $orders = $ordersQuery->get();

        return view('adminPanel.orders.index', compact('orders'));
    }

    public function export()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
