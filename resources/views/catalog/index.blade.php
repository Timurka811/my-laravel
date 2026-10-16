@extends('layouts.shop')

@section('title', 'Каталог товаров')

@section('content')
<div class="row">
    <div class="col-md-3">
        <form method="GET" action="{{ route('catalog.index') }}" class="mb-4">
            <div class="mb-3">
                <label class="form-label">Поиск</label>
                <input type="text" name="q" class="form-control" value="{{ request('q') }}" placeholder="Название товара">
            </div>

            <div class="mb-3">
                <label class="form-label">Категория</label>
                <select name="category" class="form-select">
                    <option value="">Все категории</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Цена от</label>
                <input type="number" name="min_price" class="form-control" value="{{ request('min_price') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Цена до</label>
                <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Сортировка</label>
                <select name="sort" class="form-select">
                    <option value="">По умолчанию</option>
                    <option value="price_asc" @selected(request('sort') == 'price_asc')>Цена: по возрастанию</option>
                    <option value="price_desc" @selected(request('sort') == 'price_desc')>Цена: по убыванию</option>
                    <option value="newest" @selected(request('sort') == 'newest')>Сначала новые</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Применить</button>
            <a href="{{ route('catalog.index') }}" class="btn btn-outline-secondary w-100 mt-2">Сбросить</a>
        </form>
    </div>

    <div class="col-md-9">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($products as $product)
                <div class="col">
                    <div class="card h-100">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="text-muted small">{{ $product->category->name }}</p>
                            <p class="fw-bold">{{ number_format($product->price, 2) }} ₸</p>
                            <a href="{{ route('catalog.show', $product) }}" class="btn btn-outline-primary mt-auto">Подробнее</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Товары не найдены.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection