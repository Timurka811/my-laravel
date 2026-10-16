@extends('layouts.shop')

@section('title', 'Личный кабинет')

@section('content')
<h1>Личный кабинет</h1>
<p>Здравствуйте, {{ auth()->user()->name }}!</p>

<h3 class="mt-4">Мои заказы</h3>

@if($orders->isEmpty())
    <p>У вас пока нет заказов.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Номер</th>
                <th>Дата</th>
                <th>Сумма</th>
                <th>Статус</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ number_format($order->total, 2) }} ₸</td>
                    <td>{{ $order->statusLabel() }}</td>
                    <td><a href="{{ route('dashboard.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">Подробнее</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
@endif
@endsection