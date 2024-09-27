<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // Display all products filtered by category
    public function index(Request $request)
    {
        $category_id = $request->input('category_id');
        $categories = Category::all();

        // Fetch products by category, or all products if no category is selected
        $products = $category_id
            ? Product::where('category_id', $category_id)->get()
            : Product::all();

        return view('product.index', compact('products', 'categories', 'category_id'));
    }

    // Show the form for creating a new product
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    // Store a new product
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($validatedData);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Show the form for editing a product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('product.edit', compact('product', 'categories'));
    }

    // Update an existing product
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}

