<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderby('id','desc')->paginate(5);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0', 'max:999999'],
            'stock' => ['nullable', 'integer', 'min:0', 'max:999999'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:5120'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validate['image'] = $imageName;
        }
        $product = Product::create($validate);
        return redirect()->route('product.index')->with('success', "$product->name Product Created Successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0', 'max:999999'],
            'stock' => ['nullable', 'integer', 'min:0', 'max:999999'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:5120'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);
        if ($request->hasFile('image')) {
            if ($product->image && file_exists('images/' . $product->image)) {
                unlink(public_path('images/' . $product->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validate['image'] = $imageName;
        } else {
            $imageName['image'] = $product->image;
        }
        $product->update($validate);
        return redirect()->route('product.index')->with('success', "$product->name Product Updated Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', "$product->name Product Deleted Successfully.");
    }
    public function productbuy(Request $request,Product $product){
        Order::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'amount' => $request->product_amount,
            'quantity' => $request->quantity,
            'status' => $request->status
        ]);
        return redirect()->route('product.index')->with('success',"$product->name Product Has Been Buy.");
    }
}
