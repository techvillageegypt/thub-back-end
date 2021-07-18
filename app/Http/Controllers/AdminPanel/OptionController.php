<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateOptionRequest;
use App\Http\Requests\AdminPanel\UpdateOptionRequest;
use App\Repositories\AdminPanel\OptionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class OptionController extends AppBaseController
{
    /** @var  OptionRepository */
    private $optionRepository;

    public function __construct(OptionRepository $optionRepo)
    {
        $this->optionRepository = $optionRepo;
    }

    /**
     * Display a listing of the Option.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $options = $this->optionRepository->all();

        return view('adminPanel.options.index')
            ->with('options', $options);
    }

    /**
     * Show the form for creating a new Option.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.options.create');
    }

    /**
     * Store a newly created Option in storage.
     *
     * @param CreateOptionRequest $request
     *
     * @return Response
     */
    public function store(CreateOptionRequest $request)
    {
        $input = $request->all();

        $option = $this->optionRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/options.singular')]));

        return redirect(route('adminPanel.options.index'));
    }

    /**
     * Display the specified Option.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            Flash::error(__('messages.not_found', ['model' => __('models/options.singular')]));

            return redirect(route('adminPanel.options.index'));
        }

        return view('adminPanel.options.show')->with('option', $option);
    }

    /**
     * Show the form for editing the specified Option.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            Flash::error(__('messages.not_found', ['model' => __('models/options.singular')]));

            return redirect(route('adminPanel.options.index'));
        }

        return view('adminPanel.options.edit')->with('option', $option);
    }

    /**
     * Update the specified Option in storage.
     *
     * @param int $id
     * @param UpdateOptionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOptionRequest $request)
    {
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            Flash::error(__('messages.not_found', ['model' => __('models/options.singular')]));

            return redirect(route('adminPanel.options.index'));
        }

        // Define Currunt fav_icon Path
        $fav_icon = "uploads/images/original/$option->fav_icon";
        $fav_icon_thumbnail = "uploads/images/thumbnail/$option->fav_icon";
        // Define Currunt logo Path
        $logo = "uploads/images/original/$option->logo";
        $logo_thumbnail = "uploads/images/thumbnail/$option->logo";
        // Define Currunt welcome_photo Path
        $welcome_photo = "uploads/images/original/$option->welcome_photo";
        $welcome_photo_thumbnail = "uploads/images/thumbnail/$option->welcome_photo";

        $option = $this->optionRepository->update($request->all(), $id);

        if ($request->fav_icon) {
            // Deleting Current fav_icon
            if (file_exists($fav_icon)) {
                unlink(public_path($fav_icon));
            }
            if (file_exists($fav_icon_thumbnail)) {
                unlink(public_path($fav_icon_thumbnail));
            }
        }

        if ($request->logo) {
            // Deleting Current logo
            if (file_exists($logo)) {
                unlink(public_path($logo));
            }
            if (file_exists($logo_thumbnail)) {
                unlink(public_path($logo_thumbnail));
            }
        }

        if ($request->welcome_photo) {
            // Deleting Current welcome_photo
            if (file_exists($welcome_photo)) {
                unlink(public_path($welcome_photo));
            }
            if (file_exists($welcome_photo_thumbnail)) {
                unlink(public_path($welcome_photo_thumbnail));
            }
        }

        Flash::success(__('messages.updated', ['model' => __('models/options.singular')]));

        return back();
    }

    /**
     * Remove the specified Option from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            Flash::error(__('messages.not_found', ['model' => __('models/options.singular')]));

            return redirect(route('adminPanel.options.index'));
        }

        $this->optionRepository->delete($id);

        // Define Currunt fav_icon Path
        $fav_icon = "uploads/images/original/$option->fav_icon";
        $fav_icon_thumbnail = "uploads/images/thumbnail/$option->fav_icon";

        // Define Currunt logo Path
        $logo = "uploads/images/original/$option->logo";
        $logo_thumbnail = "uploads/images/thumbnail/$option->logo";

        // Define Currunt welcome_photo Path
        $welcome_photo = "uploads/images/original/$option->welcome_photo";
        $welcome_photo_thumbnail = "uploads/images/thumbnail/$option->welcome_photo";

        // Deleting Current fav_icon
        if (file_exists($fav_icon)) {
            unlink(public_path($fav_icon));
        }
        if (file_exists($fav_icon_thumbnail)) {
            unlink(public_path($fav_icon_thumbnail));
        }

        // Deleting Current logo
        if (file_exists($logo)) {
            unlink(public_path($logo));
        }
        if (file_exists($logo_thumbnail)) {
            unlink(public_path($logo_thumbnail));
        }

        // Deleting Current welcome_photo
        if (file_exists($welcome_photo)) {
            unlink(public_path($welcome_photo));
        }
        if (file_exists($welcome_photo_thumbnail)) {
            unlink(public_path($welcome_photo_thumbnail));
        }



        Flash::success(__('messages.deleted', ['model' => __('models/options.singular')]));

        return redirect(route('adminPanel.options.index'));
    }
}
