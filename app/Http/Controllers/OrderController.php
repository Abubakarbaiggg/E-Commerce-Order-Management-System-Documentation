<?php

namespace App\Http\Controllers;

use App\Events\OrderDeleted;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Events\OrderCreated;
use App\Observers\OrderObserver;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['product', 'user'])->where('status', 'Completed')->orderby('id', 'desc')->paginate(5);
        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        Order::with('product')->create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'status' => $request->status
        ]);
        return redirect()->route('product.index')->with('success', "$product->name Product Has Been Buy.");
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $product = Product::findOrFail($id)->where('id', $id)->first();
        return view('order.create', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $order->with('product')->first();
        return view('order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->update([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'status' => $request->status
        ]);
        return redirect()->route('cardview')->with('success', "Order Has Been Updated Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('cardview')->with('success', "Order Deleted Successfully.");
    }

    public function cardview()
    {
        $orders = Order::with('product')->where('user_id', auth()->id())
                  ->where('status','!=','Completed')->orderby('id', 'desc')->paginate(5);
        $total_price = Order::where('user_id', auth()->id())
            ->join('products', 'products.id', '=', 'orders.product_id')
            ->selectRaw('SUM(products.price * orders.quantity) as total')->value('total');
        return view('product.card', compact('orders', 'total_price'));
    }
}


