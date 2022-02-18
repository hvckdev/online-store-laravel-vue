<?php

namespace App\Http\Controllers\Web\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateProductCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateProductCategoryRequest;
use App\Models\Product\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Categories/Index', [
            'categories' => Category::paginate(15)
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
        Category::firstOrCreate($request->validated());

        return Redirect::route('category.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductCategoryRequest $request
     * @param \App\Models\Product\Category $category
     * @return RedirectResponse
     */
    public function update(UpdateProductCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return Redirect::route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product\Category $category
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->deleteOrFail();

        return Redirect::route('category.index');
    }
}
