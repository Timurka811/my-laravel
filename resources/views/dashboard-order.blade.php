@extends('layouts.shop')

@section('title', 'Заказ '.$order->order_number)

@section('content')
<h1>Заказ {{ $order->order_number }}</h1>
<p>Статус: {{ $order->statusLabel() }}</p>
<p>Адрес: {{ $order->address }}</p>

<table class="table">
    <thead>
        <tr>
            <th>Товар</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Сумма</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ number_format($item->price, 2) }} ₸</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price * $item->quantity, 2) }} ₸</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4>Итого: {{ number_format($order->total, 2) }} ₸</h4>

<a href="{{ route('dashboard') }}" class="btn btn-secondary">Назад</a>
@endsection