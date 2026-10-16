@extends('layouts.admin')
@section('title', 'Заказ '.$order->order_number)
@section('content')
<h1>Заказ {{ $order->order_number }}</h1>
<p>Клиент: {{ $order->name }}, {{ $order->phone }}, {{ $order->email }}</p>
<p>Адрес: {{ $order->address }}</p>
<p>Комментарий: {{ $order->comment }}</p>

<form method="POST" action="{{ route('admin.orders.status', $order) }}" class="d-flex gap-2 mb-4">
    @csrf
    @method('PATCH')
    <select name="status" class="form-select" style="max-width: 250px;">
        @foreach(\App\Models\Order::STATUSES as $key => $label)
            <option value="{{ $key }}" @selected($order->status == $key)>{{ $label }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary">Обновить статус</button>
</form>

<table class="table">
    <thead><tr><th>Товар</th><th>Цена</th><th>Кол-во</th><th>Сумма</th></tr></thead>
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
<a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Назад</a>
@endsection