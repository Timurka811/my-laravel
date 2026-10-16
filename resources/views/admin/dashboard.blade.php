@extends('layouts.admin')
@section('title', 'Дашборд')
@section('content')
<h1>Дашборд</h1>
<div class="row g-3">
    <div class="col-md-3"><div class="card p-3">Товары: <strong>{{ $stats['products'] }}</strong></div></div>
    <div class="col-md-3"><div class="card p-3">Категории: <strong>{{ $stats['categories'] }}</strong></div></div>
    <div class="col-md-3"><div class="card p-3">Заказы: <strong>{{ $stats['orders'] }}</strong></div></div>
    <div class="col-md-3"><div class="card p-3">Новые заказы: <strong>{{ $stats['new_orders'] }}</strong></div></div>
    <div class="col-md-3"><div class="card p-3">Выручка: <strong>{{ number_format($stats['revenue'], 2) }} ₸</strong></div></div>
</div>
@endsection