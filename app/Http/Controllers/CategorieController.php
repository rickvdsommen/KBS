<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategorieController extends Controller
{
    public function index(Request $request)
    {
    // Start building the query
    $query = Category::query();
    
    // Retrieve search query from request
    $search = $request->query('search');

    // Query categories and filter by search query
    if ($search) {
        $query->where('category', 'like', '%' . $search . '%');
    }

    // Paginate the results
    $categories = $query->paginate(5); // Adjust the pagination as needed

    // Pass the paginated categories to the view
    return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255|unique:categories',
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category' => 'required|string|max:255|unique:categories,category,' . $category->id,
        ]);

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }

}
