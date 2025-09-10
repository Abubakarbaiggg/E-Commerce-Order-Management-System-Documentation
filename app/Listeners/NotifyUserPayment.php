<?php

namespace App\Listeners;

use App\Events\PaymentCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyUserPayment
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentCompleted $event): void
    {

    $user   = auth()->user();
    $orders = $event->result;

    $message = "Hello {$user->name},\n\nYour Payment Was Successful.\n\nOrder Details:\n";

    foreach ($orders as $order) {
        $message .= "Product ID: {$order['product_id']}, ";
        $message .= "Product: {$order['product']}, ";
        $message .= "Quantity: {$order['quantity']}, ";
        $message .= "Total: Rs. {$order['totalPrice']}\n";
    }

    $message .= "\nThank you for shopping with us!";

    Mail::raw($message, function ($mail) use ($user) {
        $mail->to($user->email)->subject('Payment Successfully');
    });
}

}
