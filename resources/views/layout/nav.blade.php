
<nav class="d-flex bg-dark py-2 px-4 justify-content-between" id="top-navbar">
    <div class="d-flex align-items-center">
        <a class="text-decoration-none text-white fw-bold"   href="{{route('home')}}">Infinity Travel</a>
    </div>
    <div class="dropdown">
        <button class="btn dropdown-toggle text-white" type="button" data-bs-toggle="dropdown">{{ Auth::user()->firstname }}</button>
        <ul class="dropdown-menu">
            <li class="text-center mb-2"><a href="{{route('users.info', Auth::id())}}" class="text-decoration-none text-secondary">Профил</a></li>
            <li class="text-center"><a href="{{route('logout')}}" class="text-decoration-none text-secondary">Одлогирај се</a></li>
        </ul>
    </div>
</nav>
<nav class="bg-dark" id="left-navbar">
    <ul class="navbar-nav">
        @if (request()->is('home'))
            <li class="li-link"><a href="{{route('home')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links active">Почетна</a></li>
        @else
            <li class="li-link"><a href="{{route('home')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links">Почетна</a></li>
        @endif

        @if (request()->is('accommodation') || request()->is('accommodation/*'))
            <li class="li-link"><a href="{{route('accommodation.index')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links active">Сместувања</a></li>
        @else
            <li class="li-link"><a href="{{route('accommodation.index')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links">Сместувања</a></li>
        @endif

        @if (request()->is('location/*') || request()->is('location'))
            <li class="li-link"><a href="{{route('location.index')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links active">Дестинации</a></li>
        @else
            <li class="li-link"><a href="{{route('location.index')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links">Дестинации</a></li>
        @endif

        @if (request()->is('testimonial/*') || request()->is('testimonial'))
            <li class="li-link"><a href="{{route('testimonial.index')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links active">Тестимониал</a></li>
        @else
            <li class="li-link"><a href="{{route('testimonial.index')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links">Тестимониал</a></li>
        @endif

        @if (request()->is('subscribers/*') || request()->is('subscribers'))
            <li class="li-link"><a href="{{route('subscribers.show')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links active">Претплатници</a></li>
        @else
            <li class="li-link"><a href="{{route('subscribers.show')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links">Претплатници</a></li>
        @endif

        @if (request()->is('tickets/*'))
            <li class="li-link"><a href="{{route('tickets.index')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links active">Билети</a></li>
        @else
            <li class="li-link"><a href="{{route('tickets.index')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links">Билети</a></li>
        @endif

        @if (request()->is('offers/*'))
            <li class="li-link"><a href="{{route('offers.index')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links active">Понуди</a></li>
        @else
            <li class="li-link"><a href="{{route('offers.index')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links">Понуди</a></li>
        @endif
        @auth
            @if(Auth::user()->type === 'admin')
                @if (request()->is('users') || request()->is('users/*'))
                    <li class="li-link"><a href="{{route('users')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links active">Корисници</a></li>
                @else
                    <li class="li-link"><a href="{{route('users')}}" class="text-decoration-none text-white d-block py-3 px-4 li-links">Корисници</a></li>
                @endif
            @endif
        @endauth
    </ul>
</nav>
