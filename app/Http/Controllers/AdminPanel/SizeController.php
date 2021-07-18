<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateSizeRequest;
use App\Http\Requests\AdminPanel\UpdateSizeRequest;
use App\Repositories\AdminPanel\SizeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SizeController extends AppBaseController
{
    /** @var  SizeRepository */
    private $sizeRepository;

    public function __construct(SizeRepository $sizeRepo)
    {
        $this->sizeRepository = $sizeRepo;
    }

    /**
     * Display a listing of the Size.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $sizes = $this->sizeRepository->all();

        return view('adminPanel.sizes.index')
            ->with('sizes', $sizes);
    }

    /**
     * Show the form for creating a new Size.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.sizes.create');
    }

    /**
     * Store a newly created Size in storage.
     *
     * @param CreateSizeRequest $request
     *
     * @return Response
     */
    public function store(CreateSizeRequest $request)
    {
        $input = $request->all();

        $size = $this->sizeRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/sizes.singular')]));

        return redirect(route('adminPanel.sizes.index'));
    }

    /**
     * Display the specified Size.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $size = $this->sizeRepository->find($id);

        if (empty($size)) {
            Flash::error(__('messages.not_found', ['model' => __('models/sizes.singular')]));

            return redirect(route('adminPanel.sizes.index'));
        }

        return view('adminPanel.sizes.show')->with('size', $size);
    }

    /**
     * Show the form for editing the specified Size.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $size = $this->sizeRepository->find($id);

        if (empty($size)) {
            Flash::error(__('messages.not_found', ['model' => __('models/sizes.singular')]));

            return redirect(route('adminPanel.sizes.index'));
        }

        return view('adminPanel.sizes.edit')->with('size', $size);
    }

    /**
     * Update the specified Size in storage.
     *
     * @param int $id
     * @param UpdateSizeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSizeRequest $request)
    {
        $size = $this->sizeRepository->find($id);

        if (empty($size)) {
            Flash::error(__('messages.not_found', ['model' => __('models/sizes.singular')]));

            return redirect(route('adminPanel.sizes.index'));
        }

        $size = $this->sizeRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/sizes.singular')]));

        return redirect(route('adminPanel.sizes.index'));
    }

    /**
     * Remove the specified Size from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $size = $this->sizeRepository->find($id);

        if (empty($size)) {
            Flash::error(__('messages.not_found', ['model' => __('models/sizes.singular')]));

            return redirect(route('adminPanel.sizes.index'));
        }

        $this->sizeRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/sizes.singular')]));

        return redirect(route('adminPanel.sizes.index'));
    }
}
