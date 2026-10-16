@extends('layouts.admin')
@section('title', 'Новая категория')
@section('content')
<h1>Новая категория</h1>
<form method="POST" action="{{ route('admin.categories.store') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Название</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
@endsection