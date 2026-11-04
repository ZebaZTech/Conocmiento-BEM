<header class="header">
    <div class="header__inner container">
        <a href="{{ route('home') }}" class="logo">
            <x-application-logo class="logo__mark" aria-hidden="true" />
            <span class="logo__text">Focus Work</span>
        </a>
        <x-nav />
        <div class="header__actions">
            @guest
                <a href="{{ route('login') }}" class="nav__link {{ request()->routeIs('login') ? 'nav__link--active' : '' }}">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="button button--small">Empezar gratis</a>
            @else
                <a href="{{ route('dashboard') }}" class="button button--small">Mi panel</a>
            @endguest
        </div>
    </div>
</header>
