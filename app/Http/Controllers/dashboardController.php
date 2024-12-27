<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Models\UserInfo;
class dashboardController extends Controller
{
    public function index()
    {

        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }
        $userInfo = DB::table('userinfo')->where('uid', session('user_id'))->first();


        // Fetch data from the database
        $totalOrders = DB::table('orders')->count();
        $totalProducts = DB::table('products')->count();
        $totalCategories = DB::table('categories')->count();
        $totalCustomers = DB::table('customers')->count();

        // Pass the data to the view
        return view('dashboard', compact('totalOrders', 'totalProducts', 'totalCategories', 'totalCustomers','userInfo'));
    }
   
}
