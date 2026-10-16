@extends('layouts.admin')
@section('title', 'Категории')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1>Категории</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Добавить</a>
</div>

<table class="table">
    <thead><tr><th>Название</th><th>Товаров</th><th></th></tr></thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->products_count }}</td>
            <td class="d-flex gap-2">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-secondary">Изменить</a>
                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Удалить категорию вместе с товарами?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $categories->links() }}
@endsection