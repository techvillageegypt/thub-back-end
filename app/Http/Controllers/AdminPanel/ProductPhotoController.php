<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateProductPhotoRequest;
use App\Http\Requests\AdminPanel\UpdateProductPhotoRequest;
use App\Repositories\AdminPanel\ProductPhotoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ProductPhotoController extends AppBaseController
{
    /** @var  ProductPhotoRepository */
    private $productPhotoRepository;

    public function __construct(ProductPhotoRepository $productPhotoRepo)
    {
        $this->productPhotoRepository = $productPhotoRepo;
    }

    /**
     * Display a listing of the ProductPhoto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $productPhotos = $this->productPhotoRepository->all();

        return view('adminPanel.product_photos.index')
            ->with('productPhotos', $productPhotos);
    }

    /**
     * Show the form for creating a new ProductPhoto.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.product_photos.create');
    }

    /**
     * Store a newly created ProductPhoto in storage.
     *
     * @param CreateProductPhotoRequest $request
     *
     * @return Response
     */
    public function store(CreateProductPhotoRequest $request)
    {
        $input = $request->all();

        $productPhoto = $this->productPhotoRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/productPhotos.singular')]));

        return redirect(route('adminPanel.productPhotos.index'));
    }

    /**
     * Display the specified ProductPhoto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productPhoto = $this->productPhotoRepository->find($id);

        if (empty($productPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/productPhotos.singular')]));

            return redirect(route('adminPanel.productPhotos.index'));
        }

        return view('adminPanel.product_photos.show')->with('productPhoto', $productPhoto);
    }

    /**
     * Show the form for editing the specified ProductPhoto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productPhoto = $this->productPhotoRepository->find($id);

        if (empty($productPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/productPhotos.singular')]));

            return redirect(route('adminPanel.productPhotos.index'));
        }

        return view('adminPanel.product_photos.edit')->with('productPhoto', $productPhoto);
    }

    /**
     * Update the specified ProductPhoto in storage.
     *
     * @param int $id
     * @param UpdateProductPhotoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductPhotoRequest $request)
    {
        $productPhoto = $this->productPhotoRepository->find($id);

        if (empty($productPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/productPhotos.singular')]));

            return redirect(route('adminPanel.productPhotos.index'));
        }

        $productPhoto = $this->productPhotoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/productPhotos.singular')]));

        return redirect(route('adminPanel.productPhotos.index'));
    }

    /**
     * Remove the specified ProductPhoto from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productPhoto = $this->productPhotoRepository->find($id);

        if (empty($productPhoto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/productPhotos.singular')]));

            return redirect(route('adminPanel.productPhotos.index'));
        }

        $this->productPhotoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/productPhotos.singular')]));

        return redirect(route('adminPanel.productPhotos.index'));
    }
}
