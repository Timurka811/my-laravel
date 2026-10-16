@extends('layouts.admin')
@section('title', 'Заказы')
@section('content')
<h1>Заказы</h1>

<form method="GET" class="mb-3">
    <select name="status" class="form-select" style="max-width: 250px;" onchange="this.form.submit()">
        <option value="">Все статусы</option>
        @foreach(\App\Models\Order::STATUSES as $key => $label)
            <option value="{{ $key }}" @selected(request('status') == $key)>{{ $label }}</option>
        @endforeach
    </select>
</form>

<table class="table">
    <thead><tr><th>Номер</th><th>Клиент</th><th>Сумма</th><th>Статус</th><th>Дата</th><th></th></tr></thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->order_number }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ number_format($order->total, 2) }} ₸</td>
            <td>{{ $order->statusLabel() }}</td>
            <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
            <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">Подробнее</a></td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $orders->links() }}
@endsection