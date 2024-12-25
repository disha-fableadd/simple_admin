<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    public function display()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }
        $userInfo = DB::table('userinfo')->where('uid', session('user_id'))->first();

        $products = Product::with('category')->get(); // Fetch products with related category
        return view('products.display', compact('products','userInfo'));
    }

    public function create()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }
        $userInfo = DB::table('userinfo')->where('uid', session('user_id'))->first();

        $categories = Category::all();  // Fetch all categories
        return view('products.create', compact('categories','userInfo'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'category' => 'required|exists:categories,cid',
            'img' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'stock' => 'required|integer|min:0',
        ]);


        $imagePath = $request->file('img')->store('products', 'public');


        Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'cid' => $validated['category'],
            'stock' => $validated['stock'],
            'img' => $imagePath,
        ]);

        return redirect()->route('products.display')->with('success', 'Product added successfully.');
    }

    public function edit($productid)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }
        $userInfo = DB::table('userinfo')->where('uid', session('user_id'))->first(); 

        $product = Product::where('pid', $productid)->firstOrFail();

        $categories = Category::all();
        return view('products.edit', compact('product', 'categories','userInfo'));
    }

    public function update(Request $request, $productid)
    {
        $product = Product::where('pid', $productid)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'category' => 'required|exists:categories,cid',
            'img' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
            'stock' => 'required|integer|min:0',
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->cid = $request->category;
        $product->stock = $request->stock;

        if ($request->hasFile('img')) {
            if ($product->img && \Storage::exists('public/' . $product->img)) {
                \Storage::delete('public/' . $product->img);
            }

            $imagePath = $request->file('img')->store('products', 'public');
            $product->img = $imagePath;
        }

        $product->save();

        return redirect()->route('products.display')->with('success', 'Product updated successfully!');
    }


    public function destroy($pid)
    {
        $product = Product::findOrFail($pid);

        $product->delete();

        return redirect()->route('products.display');
    }


}
