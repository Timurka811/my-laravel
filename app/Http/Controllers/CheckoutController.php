<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function create()
    {
        $cart = Cart::current()->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста.');
        }

        return view('checkout.create', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = Cart::current()->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:32',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string|max:255',
            'comment' => 'nullable|string|max:1000',
            'payment_method' => 'required|in:cash,card',
        ]);

        $order = DB::transaction(function () use ($cart, $data) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-'.strtoupper(Str::random(8)),
                'status' => 'new',
                'total' => $cart->totalPrice(),
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'] ?? null,
                'address' => $data['address'],
                'comment' => $data['comment'] ?? null,
                'payment_method' => $data['payment_method'],
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            $cart->items()->delete();

            return $order;
        });

        return redirect()->route('checkout.success', $order)->with('success', 'Заказ оформлен!');
    }

    public function success(Order $order)
    {
        return view('checkout.success', compact('order'));
    }
}
