<?php

namespace App\Http\Controllers\AdminPanel;

use App\Exports\DriversExport;
use Flash;
use Response;
use App\Models\State;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Helpers\HelperFunctionTrait;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AdminPanel\DriverRepository;
use App\Http\Requests\AdminPanel\CreateDriverRequest;
use App\Http\Requests\AdminPanel\UpdateDriverRequest;

class DriverController extends AppBaseController
{
    use HelperFunctionTrait;

    /** @var  DriverRepository */
    private $driverRepository;

    public function __construct(DriverRepository $driverRepo)
    {
        $this->driverRepository = $driverRepo;
    }


    public function index(Request $request)
    {
        $drivers = $this->driverRepository->all();

        return view('adminPanel.drivers.index')
            ->with('drivers', $drivers);
    }

    /**
     * Show the form for creating a new driver.
     *
     * @return Response
     */
    public function create()
    {
        $states = State::get()->pluck('name', 'id');

        return view('adminPanel.drivers.create', compact('states'));
    }

    /**
     * Store a newly created driver in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $request->validate(Driver::$rules);
        $request->validate(['phone' => 'required|unique:users,phone']);
        $driver = Driver::create($input);

        $driver->user()->create([
            'verify_code'   => $this->randomCode(4),
            'phone'         => $request->phone,
            'userable_id'   => $driver->id,
            'userable_type' => "App\Models\Driver",
            'type'          => "driver",
        ]);

        Flash::success('Driver saved successfully.');

        return redirect(route('adminPanel.drivers.index'));
    }

    public function show($id)
    {
        $driver = $this->driverRepository->find($id);

        if (empty($driver)) {
            Flash::error(__('messages.not_found', ['model' => __('models/drivers.singular')]));

            return redirect(route('adminPanel.drivers.index'));
        }

        return view('adminPanel.drivers.show')->with('driver', $driver);
    }

    /**
     * Show the form for editing the specified driver.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $driver = Driver::find($id);

        if (empty($driver)) {
            Flash::error('driver not found');

            return redirect(route('adminPanel.drivers.index'));
        }
        $states = State::get()->pluck('name', 'id');



        return view('adminPanel.drivers.edit', compact('states', 'driver'));
    }

    /**
     * Update the specified driver in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $driver = Driver::find($id);
        $request->validate(Driver::$rules);
        if (empty($driver)) {
            Flash::error('driver not found');

            return redirect(route('adminPanel.drivers.index'));
        }

        $driver->update($request->all());
        if (request('phone')) {
            $driver->user->update(['phone' => request('phone')]);
        }

        Flash::success('driver updated successfully.');

        return redirect(route('adminPanel.drivers.index'));
    }

    /**
     * Remove the specified driver from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $driver = Driver::find($id);

        if (empty($driver)) {
            Flash::error('driver not found');

            return redirect(route('adminPanel.drivers.index'));
        }

        $driver->delete($id);

        Flash::success('driver deleted successfully.');

        return redirect(route('adminPanel.drivers.index'));
    }

    public function deactivate(Driver $driver)
    {
        $driver->user->update(['status' => 0]);

        return back();
    }



    public function export()
    {
        return Excel::download(new DriversExport, 'drivers.xlsx');
    }
}
