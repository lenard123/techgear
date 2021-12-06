<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\EditCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::all();

        return view('admin.categories.index')
            ->with('categories', $categories);
    }

    public function create(CreateCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', '1 New Category Successfully Added');

    }

    public function showCreateForm()
    {
        return view('admin.categories.create');
    }

    public function show(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category
        ]);
    }

    public function edit(Category $category, EditCategoryRequest $request)
    {
        $category->update($request->validated());
        return redirect()
            ->route('admin.categories.index')
            ->with('success', '1 Category updated successfully');
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()
            ->route('admin.categories.index')
            ->with('success', '1 Category deleted successfully');
    }
}
