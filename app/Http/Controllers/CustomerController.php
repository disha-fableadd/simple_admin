<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CustomerController extends Controller
{
    public function display()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }
        $userInfo = DB::table('userinfo')->where('uid', session('user_id'))->first();
        $customers = Customer::all();
        return view('customers.display', compact('customers', 'userInfo'));
    }
    public function create()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }
        $userInfo = DB::table('userinfo')->where('uid', session('user_id'))->first();

        return view('customers.create', compact('userInfo'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string',
            'contact' => 'required|numeric',
            'email' => 'required|email|unique:customers,email',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
        ]);

        // Create a new customer
        Customer::create($request->all());

        return redirect()->route('customers.display');
    }

    // Edit the customer details
    public function edit($custid)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }
        $userInfo = DB::table('userinfo')->where('uid', session('user_id'))->first();

        $customer = Customer::find($custid);
        return view('customers.edit', compact('customer', 'userInfo'));
    }


    public function update(Request $request, $customerid)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string',
            'contact' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
        ]);

        $customer = Customer::where('custid', $customerid)->firstOrFail();
        $customer->update($request->all());

        return redirect()->route('customers.display')->with('success', 'Customer updated successfully');
    }

    public function destroy($custid)
    {
        $customer = Customer::findOrFail($custid);
        $customer->delete();

        return redirect()->route('customers.display')->with('success', 'Customer deleted successfully');
    }

}
