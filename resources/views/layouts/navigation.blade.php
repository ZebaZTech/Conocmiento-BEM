<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <x-application-logo class="text-dark" style="height: 36px; width: auto;" />
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="Alternar navegación">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavigation">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </li>
                @if (auth()->user()->is_admin)
                    <li class="nav-item">
                        <x-nav-link :href="route('admin.plans.index')" :active="request()->routeIs('admin.plans.*')">
                            {{ __('Planes') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('admin.testimonials.index')" :active="request()->routeIs('admin.testimonials.*')">
                            {{ __('Testimonios') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('admin.contact-messages.index')" :active="request()->routeIs('admin.contact-messages.*')">
                            {{ __('Mensajes') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                            {{ __('Categorías') }}
                        </x-nav-link>
                    </li>
                @endif
            </ul>

            <div class="d-flex align-items-center mt-3 mt-md-0">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="btn btn-link nav-link dropdown-toggle text-decoration-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
