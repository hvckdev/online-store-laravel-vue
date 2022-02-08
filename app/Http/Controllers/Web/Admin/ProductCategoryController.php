<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateProductCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class ProductCategoryController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(ProductCategory::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Categories/Index', [
            'categories' => ProductCategory::paginate(15)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProductCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CreateProductCategoryRequest $request): RedirectResponse
    {
        ProductCategory::firstOrCreate($request->validated());

        return Redirect::route('category.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductCategoryRequest $request
     * @param ProductCategory $category
     * @return RedirectResponse
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $category): RedirectResponse
    {
        $category->update($request->validated());

        return Redirect::route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductCategory $category
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(ProductCategory $category): RedirectResponse
    {
        $category->deleteOrFail();

        return Redirect::route('category.index');
    }
}
