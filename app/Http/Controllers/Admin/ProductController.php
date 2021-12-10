<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateProductRequest;
use App\Http\Requests\Admin\EditProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Services\ImageUploadService;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::with('image', 'category')->paginate(6);

        return view('admin.products.index', [
            'products' => $products
        ]);
    }

    public function showCreateForm()
    {
        return view('admin.products.create', [
            'categories' => Category::all()
        ]);
    }

    public function create(CreateProductRequest $request)
    {
        $product = new Product;
        $product->fill($request->validated());
        $product->image_id = ImageUploadService::upload('image');
        $product->is_published = $request->has('is_published');
        $product->is_featured = $request->has('is_featured');
        $product->save();

        return redirect()
            ->route('admin.products.index')
            ->with('success', '1 new producted added successfully.');
    }

    public function show(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
        ]);
    }

    public function edit(EditProductRequest $request, Product $product)
    {
        $product->fill($request->validated());

        $product->is_published = $request->has('is_published');
        $product->is_featured = $request->has('is_featured');

        if ($request->file('image')) {
            $product->image_id = ImageUploadService::upload('image');
        }

        $product->save();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');

    }

    public function delete(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }
}
