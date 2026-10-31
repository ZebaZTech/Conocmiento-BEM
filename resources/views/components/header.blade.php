<header class="header">
    <div class="header__inner container">
        <a href="{{ route('home') }}" class="logo">
            <span class="logo__mark">⏱</span>
            <span class="logo__text">Focus Work</span>
        </a>
        <x-nav />
        <div class="header__actions">
            <a href="{{ route('planes') }}" class="button button--small header__cta">Empezar gratis</a>
            <div class="header__auth">
                @guest
                    <a href="{{ route('login') }}" class="nav__link {{ request()->routeIs('login') ? 'nav__link--active' : '' }}">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="button button--small">Registrarse</a>
                @else
                    <a href="{{ route('dashboard') }}" class="button button--small">Mi panel</a>
                @endguest
            </div>
        </div>
    </div>
</header>
