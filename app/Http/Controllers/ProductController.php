<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 1. Start the query
        $query = Product::query();

        // 2. Check if there is a search term
        if ($request->has('search')) {
            $search = $request->get('search');

            // Search by Name OR Brand
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('processor', 'like', "%{$search}%"); // Optional: Search specs too
            });
        }

        // 3. Get results (with pagination)
        $products = $query->latest()->paginate(12);

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}
