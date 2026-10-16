@extends('layouts.shop')

@section('title', 'Оформление заказа')

@section('content')
<h1>Оформление заказа</h1>

<div class="row">
    <div class="col-md-7">
        <form method="POST" action="{{ route('checkout.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Имя</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name ?? '') }}">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Телефон</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email ?? '') }}">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Адрес доставки</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Комментарий</label>
                <textarea name="comment" class="form-control">{{ old('comment') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Способ оплаты</label>
                <select name="payment_method" class="form-select">
                    <option value="cash">Наличными при получении</option>
                    <option value="card">Картой онлайн</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Подтвердить заказ</button>
        </form>
    </div>

    <div class="col-md-5">
        <h4>Ваш заказ</h4>
        <ul class="list-group mb-3">
            @foreach($cart->items as $item)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                    <span>{{ number_format($item->product->price * $item->quantity, 2) }} ₸</span>
                </li>
            @endforeach
        </ul>
        <h5>Итого: {{ number_format($cart->totalPrice(), 2) }} ₸</h5>
    </div>
</div>
@endsection