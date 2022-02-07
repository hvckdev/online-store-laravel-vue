<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Welcome', [
            'canLogin' => $request->has('login'),
            'canRegister' => $request->has('register'),
            'products' => Product::with('category')->get(),
        ]);
    }
}
