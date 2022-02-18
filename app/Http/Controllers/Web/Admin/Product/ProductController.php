<?php

namespace App\Http\Controllers\Web\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\CreateProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\Product\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;


class ProductController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Product::class);
    }

    /**
     * Display a listing of the products.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Products/Index', [
            'products' => Product::with('category')->paginate(10),
            'categories' => Category::all(),
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

        return Redirect::route('product.index');
    }

    /**
     * Display product edit form
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Products/Create', [
            'categories' => Category::all()
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

        return Redirect::route('product.index');
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

        return Redirect::route('product.index');
    }
}
