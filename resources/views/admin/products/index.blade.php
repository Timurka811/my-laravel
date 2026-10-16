@extends('layouts.admin')
@section('title', 'Товары')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1>Товары</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Добавить</a>
</div>

<form method="GET" class="mb-3">
    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Поиск по названию" style="max-width: 300px;">
</form>

<table class="table">
    <thead><tr><th>Название</th><th>Категория</th><th>Цена</th><th>Остаток</th><th>Активен</th><th></th></tr></thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ number_format($product->price, 2) }} ₸</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->is_active ? 'Да' : 'Нет' }}</td>
            <td class="d-flex gap-2">
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-secondary">Изменить</a>
                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Удалить товар?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $products->links() }}
@endsection