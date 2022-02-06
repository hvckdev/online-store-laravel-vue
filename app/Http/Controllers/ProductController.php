<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Products/Index', [
            'products' => Product::with('category')->paginate(10),
            'categories' => ProductCategory::all(),
        ]);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param CreateProductRequest $request
     * @return RedirectResponse
     */
    public function store(CreateProductRequest $request): RedirectResponse
    {
        Product::firstOrCreate($request->hasFile('photo')
            ? array_merge($request->except(['photo']),
                ['photo_path' => $request->file('photo')
                    ->storePublicly('product-photos', ['disk' => Product::photoDisk()])]
            )
            : $request->except(['photo']));

        return redirect()->route('product.index');
    }

    /**
     * Display product edit form
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Products/Create', [
            'categories' => ProductCategory::all()
        ]);
    }

    /**
     * Update the product in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->hasFile('photo')
            ? array_merge($request->validated(),
                ['photo_path' => $request->file('photo')
                    ->storePublicly('product-photos', ['disk' => Product::photoDisk()])]
            )
            : $request->validated()
        );

        return redirect()->route('product.index');
    }

    /**
     * Remove the product from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->deleteOrFail();

        return redirect()->route('product.index');
    }
}
