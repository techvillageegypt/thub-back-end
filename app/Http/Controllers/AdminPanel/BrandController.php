<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateBrandRequest;
use App\Http\Requests\AdminPanel\UpdateBrandRequest;
use App\Repositories\AdminPanel\BrandRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Brand;
use Illuminate\Http\Request;
use Flash;
use Response;

class BrandController extends AppBaseController
{
    /** @var  BrandRepository */
    private $brandRepository;

    public function __construct(BrandRepository $brandRepo)
    {
        $this->brandRepository = $brandRepo;
    }

    /**
     * Display a listing of the Brand.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $brands = Brand::get();

        return view('adminPanel.brands.index')
            ->with('brands', $brands);
    }

    /**
     * Show the form for creating a new Brand.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.brands.create');
    }

    /**
     * Store a newly created Brand in storage.
     *
     * @param CreateBrandRequest $request
     *
     * @return Response
     */
    public function store(CreateBrandRequest $request)
    {
        $input = $request->all();

        $brand = $this->brandRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/brands.singular')]));

        return redirect(route('adminPanel.brands.index'));
    }

    /**
     * Display the specified Brand.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            Flash::error(__('messages.not_found', ['model' => __('models/brands.singular')]));

            return redirect(route('adminPanel.brands.index'));
        }

        return view('adminPanel.brands.show')->with('brand', $brand);
    }

    /**
     * Show the form for editing the specified Brand.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            Flash::error(__('messages.not_found', ['model' => __('models/brands.singular')]));

            return redirect(route('adminPanel.brands.index'));
        }

        return view('adminPanel.brands.edit')->with('brand', $brand);
    }

    /**
     * Update the specified Brand in storage.
     *
     * @param int $id
     * @param UpdateBrandRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBrandRequest $request)
    {
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            Flash::error(__('messages.not_found', ['model' => __('models/brands.singular')]));

            return redirect(route('adminPanel.brands.index'));
        }

        $brand = $this->brandRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/brands.singular')]));

        return redirect(route('adminPanel.brands.index'));
    }

    /**
     * Remove the specified Brand from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            Flash::error(__('messages.not_found', ['model' => __('models/brands.singular')]));

            return redirect(route('adminPanel.brands.index'));
        }

        $this->brandRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/brands.singular')]));

        return redirect(route('adminPanel.brands.index'));
    }
}
