<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function display()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }
        $userInfo = DB::table('userinfo')->where('uid', session('user_id'))->first();

        $categories = Category::all(); 
        return view('categories.display', compact('categories','userInfo'));
    }
    public function create()
    {

        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }
        $userInfo = DB::table('userinfo')->where('uid', session('user_id'))->first();
        
        return view('categories.create',compact('userInfo'));
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
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }
        $userInfo = DB::table('userinfo')->where('uid', session('user_id'))->first(); 

        $category = Category::where('cid', $categoryId)->firstOrFail();
        return view('categories.edit', compact('category','userInfo'));
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
