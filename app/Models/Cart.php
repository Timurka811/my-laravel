<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Cart extends Model
{
    protected $fillable = ['user_id', 'session_id'];

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Получить (или создать) корзину текущего посетителя.
     * Для авторизованных — привязка к user_id.
     * Для гостей — привязка к session_id.
     */
    public static function current(): self
    {
        if (Auth::check()) {
            return static::firstOrCreate(['user_id' => Auth::id()]);
        }

        if (! Session::has('cart_session_id')) {
            Session::put('cart_session_id', (string) Str::uuid());
        }

        return static::firstOrCreate([
            'session_id' => Session::get('cart_session_id'),
            'user_id' => null,
        ]);
    }

    public function totalPrice(): float
    {
        return (float) $this->items->sum(fn (CartItem $item) => $item->quantity * $item->product->price);
    }

    public function totalQuantity(): int
    {
        return (int) $this->items->sum('quantity');
    }
}