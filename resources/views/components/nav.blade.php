<nav class="nav" aria-label="Principal">
    <ul class="nav__list">
        <li class="nav__item"><a href="{{ route('home') }}" class="nav__link {{ request()->routeIs('home') ? 'nav__link--active' : '' }}">Inicio</a></li>
        <li class="nav__item"><a href="{{ route('caracteristicas') }}" class="nav__link {{ request()->routeIs('caracteristicas') ? 'nav__link--active' : '' }}">Características</a></li>
        <li class="nav__item"><a href="{{ route('opiniones') }}" class="nav__link {{ request()->routeIs('opiniones') ? 'nav__link--active' : '' }}">Opiniones</a></li>
        <li class="nav__item"><a href="{{ route('planes') }}" class="nav__link {{ request()->routeIs('planes') ? 'nav__link--active' : '' }}">Planes</a></li>
        <li class="nav__item"><a href="#" class="nav__link nav__link--disabled" aria-disabled="true">Blog</a></li>
    </ul>
</nav>
