<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateProductRequest;
use App\Http\Requests\AdminPanel\UpdateProductRequest;
use App\Repositories\AdminPanel\ProductRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Size;
use Illuminate\Http\Request;
use Flash;
use Response;

class ProductController extends AppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the Product.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $products = $this->productRepository->all();

        return view('adminPanel.products.index')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::get()->pluck('name', 'id');
        $sizes = Size::get()->pluck('name', 'id');
        $colors = Color::get()->pluck('name', 'id');

        return view('adminPanel.products.create', compact('categories', 'colors', 'sizes'));
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate(Product::rules());

        $input = $request->all();
        $product = $this->productRepository->create($input);

        foreach (request('photos') as $photo) {
            $product->photos()->create([
                'photo' => $photo
            ]);
        }


        foreach ($request->item as $key => $item) {
            $product->items()->create($item);
        }

        $minPrice = $product->items()->min('price');
        $minSalePrice = $product->items()->min('sale_price');
        $price = collect([$minPrice, $minSalePrice]);
        $product->update(['min_price' => $price->min()]);

        Flash::success(__('messages.saved', ['model' => __('models/products.singular')]));

        return redirect(route('adminPanel.products.index'));
    }

    /**
     * Display the specified Product.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect(route('adminPanel.products.index'));
        }

        return view('adminPanel.products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect(route('adminPanel.products.index'));
        }

        $categories = Category::get()->pluck('name', 'id');
        $sizes = Size::get()->pluck('name', 'id');
        $colors = Color::get()->pluck('name', 'id');

        return view('adminPanel.products.edit', compact('categories', 'product', 'sizes', 'colors'));
    }

    /**
     * Update the specified Product in storage.
     *
     * @param int $id
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $request->validate(array_merge(Product::rules(), ['photos' => 'nullable']));

        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect(route('adminPanel.products.index'));
        }

        if (request('photos')) {

            $product->photos()->delete();

            foreach (request('photos') as $photo) {
                $product->photos()->create([
                    'photo' => $photo
                ]);
            }
        }

        if (!empty($request->item)) {
            foreach ($request->item as $key => $item) {
                $product->items()->updateOrCreate(['id' => $key], $item);
            }
        }

        $product = $this->productRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/products.singular')]));

        return redirect(route('adminPanel.products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect(route('adminPanel.products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/products.singular')]));

        return redirect(route('adminPanel.products.index'));
    }

    public function destroyItem($id)
    {
        ProductItem::find($id)->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);

        return back();
    }
}
