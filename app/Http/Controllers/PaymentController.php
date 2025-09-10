<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Events\PaymentCompleted;

class PaymentController extends Controller
{
    public function process(Request $request){
        try{
        $orders = Order::with('product')->where('user_id',auth()->id())->where('status','Purchase')->get();
        $result = $orders->groupBy('product_id')->map(function($group){
            return [
                 'product_id' => $group->first()->product_id,
                 'product' => $group->first()->product->name,
                 'quantity' => $group->sum('quantity'),
                 'totalPrice' => $group->sum(function($order){
                    return $order->quantity * $order->product->price;
                 })
            ];
        })->toArray();
        event(new PaymentCompleted($result));
        return redirect()->route('cardview')->with('success', "Payment Has Been Successfully Completed.");
        }catch(\Exception $e){
            \Log::error("Process error:". $e->getMessage());
        }
    }
    public function processBkp(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:easypaisa,jazzcash,card',
            'total_price' => 'required|numeric|min:0',
        ]);

        $paymentMethod = $request->input('payment_method');
        $totalPrice = $request->input('total_price');

        if ($paymentMethod === 'easypaisa') {
            return $this->handleEasyPaisa($totalPrice);
        } elseif ($paymentMethod === 'jazzcash') {
            return $this->handleJazzCash($totalPrice);
        } else {
            return $this->handleCardPayment($totalPrice);
        }
    }

    private function handleEasyPaisa($amount)
    {
        // EasyPaisa Sandbox Integration (Demo)
        // Replace with actual sandbox API logic
        $apiUrl = 'https://sandbox.easypaisa.com.pk/api/payment'; // Example sandbox URL
        $merchantId = env('EASYPAISA_MERCHANT_ID'); // Add to .env
        $apiKey = env('EASYPAISA_API_KEY'); // Add to .env

        // Simulate API call (no real transaction)
        $response = [
            'status' => 'success',
            'message' => 'EasyPaisa payment initiated in sandbox mode',
            'transaction_id' => 'TEST-' . uniqid(),
            'amount' => $amount,
        ];

        return redirect()->back()->with('success', $response['message'] . ' (Transaction ID: ' . $response['transaction_id'] . ')');
    }

    private function handleJazzCash($amount)
    {
        // JazzCash Sandbox Integration (Demo)
        // Replace with actual sandbox API logic
        $apiUrl = 'https://sandbox.jazzcash.com.pk/ApplicationAPI/API/Payment/DoTransaction'; // Example sandbox URL
        $merchantId = env('JAZZCASH_MERCHANT_ID'); // Add to .env
        $password = env('JAZZCASH_PASSWORD'); // Add to .env
        $integritySalt = env('JAZZCASH_INTEGRITY_SALT'); // Add to .env

        // Simulate API call (no real transaction)
        $response = [
            'status' => 'success',
            'message' => 'JazzCash payment initiated in sandbox mode',
            'transaction_id' => 'TEST-' . uniqid(),
            'amount' => $amount,
        ];

        return redirect()->back()->with('success', $response['message'] . ' (Transaction ID: ' . $response['transaction_id'] . ')');
    }

    private function handleCardPayment($amount)
    {
        // Card Payment (Demo)
        // You can integrate a third-party like Stripe for card payments in sandbox mode
        $response = [
            'status' => 'success',
            'message' => 'Card payment initiated in sandbox mode',
            'transaction_id' => 'TEST-' . uniqid(),
            'amount' => $amount,
        ];

        return redirect()->back()->with('success', $response['message'] . ' (Transaction ID: ' . $response['transaction_id'] . ')');
    }
}
