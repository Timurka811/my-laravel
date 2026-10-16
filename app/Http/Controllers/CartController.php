<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::current()->load('items.product');

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1|max:100',
        ]);

        $cart = Cart::current();
        $quantity = (int) $request->input('quantity', 1);

        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $item->update(['quantity' => $item->quantity + $quantity]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return back()->with('success', 'Товар добавлен в корзину.');
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        $this->authorizeItem($cartItem);

        $request->validate([
            'quantity' => 'required|integer|min:1|max:100',
        ]);

        $cartItem->update(['quantity' => $request->input('quantity')]);

        return back()->with('success', 'Корзина обновлена.');
    }

    public function remove(CartItem $cartItem): RedirectResponse
    {
        $this->authorizeItem($cartItem);

        $cartItem->delete();

        return back()->with('success', 'Товар удалён из корзины.');
    }

    private function authorizeItem(CartItem $cartItem): void
    {
        abort_unless($cartItem->cart_id === Cart::current()->id, 403);
    }
}
