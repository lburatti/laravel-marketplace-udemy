<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('stylesheets')
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('home') }}">Marketplace</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                @auth
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if(request()->is('admin/orders*')) active @endif">
                        <a class="nav-link" href="{{ route('orders.my') }}">Meus Pedidos</a>
                    </li>
                    <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                        <a class="nav-link" href="{{ route('stores.index') }}">Loja<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                        <a class="nav-link" href="{{ route('products.index') }}">Produtos</a>
                    </li>
                    <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                        <a class="nav-link" href="{{ route('categories.index') }}">Categorias</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{ route('notifications.index') }}" class="nav-link">
                            <span class="badge badge-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                            <i class="fa fa-bell"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-user">Olá, {{ auth()->user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.querySelector('form.logout').submit()">Sair</a>
                        <form action="{{ route('logout') }}" class="logout" method="POST">
                            @csrf
                        </form>
                    </li>
                </ul>
                @endauth

            </div>
        </nav>
    </header>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>

    <!-- Bootstrap JS + JQuery-->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
     
</body>

</html>