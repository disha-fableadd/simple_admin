<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function display()
    {
        $categories = Category::all(); 
        return view('categories.display', compact('categories'));
    }
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);
    
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
    
        return redirect()->route('categories.display');
    }
    public function edit( $categoryId)
    {
        $category = Category::where('cid', $categoryId)->firstOrFail();
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.display');
    }
    public function destroy( $cid)
    {
        $category = Category::findOrFail($cid);
        $category->delete();
        return redirect()->route('categories.display');
    }
}
