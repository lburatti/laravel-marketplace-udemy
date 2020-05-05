<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('stylesheets')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <a class="navbar-brand" href="{{route('home')}}">Marketplace</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('/')) active @endif">
                    <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                @foreach($categories as $category)
                <li class="nav-item @if(request()->is('category/'.$category->slug)) active @endif">
                    <a class="nav-link" href="{{ route('category.single', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                </li>
                @endforeach
            </ul>

            <ul class="navbar-nav ml-auto">
                @auth
                <li class="nav-item @if(request()->is('my-orders')) active @endif">
                    <a href="{{ route('user.orders') }}" class="nav-link">Meus Pedidos</a>
                </li>
                @endauth
                <li class="nav-item">
                    <a href="{{ route('cart.index') }}" class="nav-link">
                        @if(session()->has('cart'))
                        <span class="badge badge-danger">{{ count(session()->get('cart')) }}</span>
                        @endif
                        <i class="fa fa-shopping-cart fa-2x"></i>
                    </a>
                </li>
                @auth
                <li class="nav-item m-0 p-2">
                    <span class="nav-user">Olá, {{ auth()->user()->name }}</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.querySelector('form.logout').submit()">Sair</a>
                    <form action="{{ route('logout') }}" class="logout" method="POST">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>

        </div>
    </nav>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>

    <!-- Bootstrap JS + JQuery -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')

    <footer class="footer-nav">
        <div class="container-fluid">
            <p class="m-0 p-0">2020.</p>
        </div>
    </footer>

</body>

</html>