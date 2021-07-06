<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateDonationTypeRequest;
use App\Http\Requests\AdminPanel\UpdateDonationTypeRequest;
use App\Repositories\AdminPanel\DonationTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class DonationTypeController extends AppBaseController
{
    /** @var  DonationTypeRepository */
    private $donationTypeRepository;

    public function __construct(DonationTypeRepository $donationTypeRepo)
    {
        $this->donationTypeRepository = $donationTypeRepo;
    }

    /**
     * Display a listing of the DonationType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $donationTypes = $this->donationTypeRepository->all();

        return view('adminPanel.donation_types.index')
            ->with('donationTypes', $donationTypes);
    }

    /**
     * Show the form for creating a new DonationType.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.donation_types.create');
    }

    /**
     * Store a newly created DonationType in storage.
     *
     * @param CreateDonationTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateDonationTypeRequest $request)
    {
        $input = $request->all();

        $donationType = $this->donationTypeRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/donationTypes.singular')]));

        return redirect(route('adminPanel.donationTypes.index'));
    }

    /**
     * Display the specified DonationType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $donationType = $this->donationTypeRepository->find($id);

        if (empty($donationType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/donationTypes.singular')]));

            return redirect(route('adminPanel.donationTypes.index'));
        }

        return view('adminPanel.donation_types.show')->with('donationType', $donationType);
    }

    /**
     * Show the form for editing the specified DonationType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $donationType = $this->donationTypeRepository->find($id);

        if (empty($donationType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/donationTypes.singular')]));

            return redirect(route('adminPanel.donationTypes.index'));
        }

        return view('adminPanel.donation_types.edit')->with('donationType', $donationType);
    }

    /**
     * Update the specified DonationType in storage.
     *
     * @param int $id
     * @param UpdateDonationTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDonationTypeRequest $request)
    {
        $donationType = $this->donationTypeRepository->find($id);

        if (empty($donationType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/donationTypes.singular')]));

            return redirect(route('adminPanel.donationTypes.index'));
        }

        // // Define Currunt icon Path
        // $icon = "uploads/images/original/$donationType->icon";
        // $icon_thumbnail = "uploads/images/thumbnail/$donationType->icon";

        $donationType = $this->donationTypeRepository->update($request->all(), $id);

        // if ($request->icon) {
        //     // Deleting Current icon
        //     if (file_exists($icon)) {
        //         unlink(public_path($icon));
        //     }
        //     if (file_exists($icon_thumbnail)) {
        //         unlink(public_path($icon_thumbnail));
        //     }
        // }

        Flash::success(__('messages.updated', ['model' => __('models/donationTypes.singular')]));

        return redirect(route('adminPanel.donationTypes.index'));
    }

    /**
     * Remove the specified DonationType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $donationType = $this->donationTypeRepository->find($id);

        if (empty($donationType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/donationTypes.singular')]));

            return redirect(route('adminPanel.donationTypes.index'));
        }

        $this->donationTypeRepository->delete($id);


        // Define Currunt icon Path
        $icon = "uploads/images/original/$donationType->icon";
        $icon_thumbnail = "uploads/images/thumbnail/$donationType->icon";

        if ($donationType->icon) {
            // Deleting Current icon
            if (file_exists($icon)) {
                unlink(public_path($icon));
            }
            if (file_exists($icon_thumbnail)) {
                unlink(public_path($icon_thumbnail));
            }
        }

        Flash::success(__('messages.deleted', ['model' => __('models/donationTypes.singular')]));

        return redirect(route('adminPanel.donationTypes.index'));
    }
}
