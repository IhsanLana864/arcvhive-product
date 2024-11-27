<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
    // Mendapatkan kata kunci pencarian dari input form
    $search = $request->input('search');

    $products = Product::when($search, function ($query, $search) {
        return $query->where('name', 'like', '%' . $search . '%');
    })
    ->paginate(10);

    // Format harga dengan Rupiah sebelum mengirim ke view
    foreach ($products as $product) {
        $product->formatted_price = 'Rp ' . number_format($product->price, 0, ',', '.');
    }

    return view('products.index', compact('products'));
    }

    public function create()
    {
        
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0|max:2147483647',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }
    
    public function update(Request $request, Product $product)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0|max:2147483647',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
