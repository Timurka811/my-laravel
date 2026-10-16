@extends('layouts.shop')

@section('title', 'Корзина')

@section('content')
<h1>Корзина</h1>

@if($cart->items->isEmpty())
    <p>Ваша корзина пуста.</p>
    <a href="{{ route('catalog.index') }}" class="btn btn-primary">В каталог</a>
@else
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Товар</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Сумма</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->product->price, 2) }} ₸</td>
                    <td>
                        <form method="POST" action="{{ route('cart.update', $item) }}" class="d-flex gap-2">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="100" class="form-control" style="max-width: 90px;">
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Обновить</button>
                        </form>
                    </td>
                    <td>{{ number_format($item->product->price * $item->quantity, 2) }} ₸</td>
                    <td>
                        <form method="POST" action="{{ route('cart.remove', $item) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center">
        <h4>Итого: {{ number_format($cart->totalPrice(), 2) }} ₸</h4>
        <a href="{{ route('checkout.create') }}" class="btn btn-success">Оформить заказ</a>
    </div>
@endif
@endsection