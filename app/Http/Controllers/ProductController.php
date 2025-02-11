<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::latest()->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:products,name',
            'slug' => 'nullable|string|max:100|unique:products,slug',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'numeric|min:0',
            'sku' => 'required|string|unique:products,sku',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'in_stock' => 'required|boolean',
            'is_featured' => 'required|boolean',
            'primaryImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $slug = $request->slug ?: Str::slug($request->name);
        $product = Product::create([
            'name' => $request->name,
            'slug' => $slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'sku' => $request->sku,
            'quantity' => $request->quantity,
            'in_stock' => $request->in_stock,
            'is_featured' => $request->is_featured,
        ]);
        if ($request->hasFile('primaryImage')) {
            $primaryImagePath = $request->file('primaryImage')->store('product_images', 'public');
        }
        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => $primaryImagePath,
            'primary' => 1,
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $image->store('product_images', 'public'),
                    'primary' => 0,
                ]);
            }
        }
        return redirect()->route('products.index');
    }

    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::latest()->get();
        return view('products.create', compact('product','categories'));
    }

    public function update(Request $request, string $id)
    {
        dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:products,name',
            'slug' => 'nullable|string|max:100|unique:products,slug',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'numeric|min:0',
            'sku' => 'required|string|unique:products,sku',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'in_stock' => 'required|boolean',
            'is_featured' => 'required|boolean',
            'primaryImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $slug = $request->slug ?: Str::slug($request->name);
        $product = Product::find($id);
        $product->update([
            'name' => $request->name,
            'slug' => $slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'sku' => $request->sku,
            'quantity' => $request->quantity,
            'in_stock' => $request->in_stock,
            'is_featured' => $request->is_featured,
        ]);
        if ($request->hasFile('primaryImage')) {
            $primaryImagePath = $request->file('primaryImage')->store('product_images', 'public');
            $product->images()->create([
                'image_path' => $primaryImagePath,
                'primary' => true,
            ]);
        }
        $product->categories()->sync([$request->category_id]);
        return redirect()->route('products.index');
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('products.index')->with('error', 'Product not found');
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
