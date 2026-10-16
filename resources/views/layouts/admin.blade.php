<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Админ-панель')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <nav class="bg-dark text-white p-3" style="width: 220px; min-height: 100vh;">
        <h5>Админ-панель</h5>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.dashboard') }}">Дашборд</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.categories.index') }}">Категории</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.products.index') }}">Товары</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.orders.index') }}">Заказы</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('catalog.index') }}">На сайт</a></li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-link nav-link text-white" type="submit">Выйти</button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="flex-fill p-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</div>
</body>
</html>