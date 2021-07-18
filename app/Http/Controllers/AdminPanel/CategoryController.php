<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateCategoryRequest;
use App\Http\Requests\AdminPanel\UpdateCategoryRequest;
use App\Repositories\AdminPanel\CategoryRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Flash;
use Response;

class CategoryController extends AppBaseController
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $categories = $this->categoryRepository->paginate(10);

        return view('adminPanel.categories.index')
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {
        $parents = Category::whereNull('parent_id')->get()->pluck('name', 'id');
        return view('adminPanel.categories.create', compact('parents'));
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();

        $category = $this->categoryRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/categories.singular')]));

        return redirect(route('adminPanel.categories.index'));
    }

    /**
     * Display the specified Category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error(__('messages.not_found', ['model' => __('models/categories.singular')]));

            return redirect(route('adminPanel.categories.index'));
        }

        return view('adminPanel.categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error(__('messages.not_found', ['model' => __('models/categories.singular')]));

            return redirect(route('adminPanel.categories.index'));
        }

        $parents = Category::whereNull('parent_id')->get()->pluck('name', 'id');

        return view('adminPanel.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified Category in storage.
     *
     * @param int $id
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryRequest $request)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error(__('messages.not_found', ['model' => __('models/categories.singular')]));

            return redirect(route('adminPanel.categories.index'));
        }

        $category = $this->categoryRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/categories.singular')]));

        return redirect(route('adminPanel.categories.index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error(__('messages.not_found', ['model' => __('models/categories.singular')]));

            return redirect(route('adminPanel.categories.index'));
        }

        $this->categoryRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/categories.singular')]));

        return redirect(route('adminPanel.categories.index'));
    }
}
