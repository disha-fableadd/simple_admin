<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }
        $userInfo = DB::table('userinfo')->where('uid', session('user_id'))->first();

        $customers = Customer::all(); // Retrieve all customers
        $products = Product::all(); // Retrieve all products
        return view('orders.create', compact('customers', 'products', 'userInfo'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'customerId' => 'required|exists:customers,custid',
            'orderItems' => 'required|array|min:1',
            'orderItems.*.productId' => 'required|exists:products,pid',
            'orderItems.*.quantity' => 'required|integer|min:1',
            'orderItems.*.price' => 'required|numeric',
            'orderItems.*.totalPrice' => 'required|numeric',
            'orderItems.*.image' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            // Insert into the orders table
            $orderId = DB::table('orders')->insertGetId([
                'custid' => $validated['customerId'],
                'status' => 'pending', // Default status
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert each order item into the orderitem table
            foreach ($validated['orderItems'] as $item) {
                DB::table('orderitem')->insert([
                    'oid' => $orderId,
                    'pid' => $item['productId'],
                    'qty' => $item['quantity'],
                    'price' => $item['price'],
                    'totalprice' => $item['totalPrice'],
                    'image' => $item['image'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Order created successfully!'], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function display()
    {

        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }
        $userInfo = DB::table('userinfo')->where('uid', session('user_id'))->first();

        // Eager load 'orderItems' and 'customer' relationships
        $orderItems = OrderItem::with(['order.customer', 'product'])->get();

        return view('orders.display', compact('orderItems', 'userInfo'));
    }


    public function show($id)
    {

        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }
        $userInfo = DB::table('userinfo')->where('uid', session('user_id'))->first();
        $order = Order::with('orderItems.product', 'customer')->findOrFail($id);

        return view('orders.show', compact('order', 'userInfo'));


    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $item = OrderItem::findOrFail($id);
        $item->qty = $request->qty;
        $item->totalprice = $item->price * $request->qty;
        $item->save();

        return response()->json([
            'totalPrice' => $item->totalprice,
        ]);
    }

    public function destroy($id)
    {
        $orderItem = OrderItem::findOrFail($id);

        if ($orderItem) {
            $orderItem->delete();
            return response()->json(['message' => 'Item deleted successfully.']);
        }

        return response()->json(['message' => 'Item not found.'], 404);
    }

    public function completeOrder($id)
{
    $order = Order::findOrFail($id);

    $order->status = 'completed';
    $order->save();

    return redirect()->route('orders.completed')->with('success', 'Order completed successfully');
}
public function completedOrders()
{
    if (!session()->has('user_id')) {
        return redirect()->route('login');
    }
    
    $userInfo = DB::table('userinfo')->where('uid', session('user_id'))->first();
    
    $completedOrders = Order::where('status', 'completed')->with('customer')->get();

    return view('orders.completed', compact('completedOrders', 'userInfo'));
}

}
