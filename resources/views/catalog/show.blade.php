@extends('layouts.shop')

@section('title', $product->name)

@section('content')
<div class="row">
    <div class="col-md-5">
        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
        @endif
    </div>
    <div class="col-md-7">
        <h1>{{ $product->name }}</h1>
        <p class="text-muted">{{ $product->category->name }}</p>
        <p class="fs-3 fw-bold">{{ number_format($product->price, 2) }} ₸</p>
        <p>{{ $product->description }}</p>
        <p>В наличии: {{ $product->stock }} шт.</p>

        @if($product->stock > 0)
            <form method="POST" action="{{ route('cart.add', $product) }}" class="d-flex gap-2">
                @csrf
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control" style="max-width: 100px;">
                <button type="submit" class="btn btn-primary">В корзину</button>
            </form>
        @else
            <button class="btn btn-secondary" disabled>Нет в наличии</button>
        @endif
    </div>
</div>

@if($related->isNotEmpty())
    <hr>
    <h3>Похожие товары</h3>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach($related as $item)
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h6>{{ $item->name }}</h6>
                        <p class="fw-bold">{{ number_format($item->price, 2) }} ₸</p>
                        <a href="{{ route('catalog.show', $item) }}" class="btn btn-sm btn-outline-primary">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection