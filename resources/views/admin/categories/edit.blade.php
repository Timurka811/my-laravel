@extends('layouts.admin')
@section('title', 'Изменить категорию')
@section('content')
<h1>Изменить категорию</h1>
<form method="POST" action="{{ route('admin.categories.update', $category) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Название</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
@endsection