@extends('layouts.shop')

@section('title', 'Заказ оформлен')

@section('content')
<div class="text-center py-5">
    <h1 class="text-success">Спасибо за заказ!</h1>
    <p>Номер вашего заказа: <strong>{{ $order->order_number }}</strong></p>
    <p>Сумма: {{ number_format($order->total, 2) }} ₸</p>
    <a href="{{ route('catalog.index') }}" class="btn btn-primary">Вернуться в каталог</a>
</div>
@endsection