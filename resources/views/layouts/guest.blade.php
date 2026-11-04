<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Focus Work') }}</title>

        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="auth-body">
        @php
            $authTitle = match (true) {
                request()->routeIs('login') => __('Log in'),
                request()->routeIs('register') => __('Register'),
                request()->routeIs('password.request') => 'Recuperar contraseña',
                request()->routeIs('password.reset') => __('Reset Password'),
                request()->routeIs('password.confirm') => __('Confirm'),
                request()->routeIs('verification.notice') => 'Verifica tu correo',
                default => 'Focus Work',
            };
        @endphp

        <div class="auth-shell">
            <aside class="auth-scene">
                @if (file_exists(public_path('images/login-bg.jpg')))
                    <div class="auth-scene__image" style="background-image: url('{{ asset('images/login-bg.jpg') }}');"></div>
                @else
                    <x-focus-scene class="auth-scene__svg" />
                @endif

                <div class="auth-scene__overlay"></div>

                <div class="auth-scene__content">
                    <div class="auth-scene__top">
                        <a href="{{ route('home') }}" class="auth-scene__logo">
                            <x-application-logo aria-hidden="true" />
                            <span>Focus Work</span>
                        </a>
                        <x-icon name="clock" size="44" class="auth-scene__clock" />
                    </div>

                    <div class="auth-scene__copy">
                        <h1 class="auth-scene__title">Trabaja en ciclos de 25 minutos y termina más en menos tiempo.</h1>
                        <ul class="auth-scene__points">
                            <li><x-icon name="timer" size="20" /> 25 min de enfoque</li>
                            <li><x-icon name="coffee" size="20" /> 5 min de descanso</li>
                            <li><x-icon name="shield" size="20" /> Cero distracciones</li>
                        </ul>
                    </div>
                </div>
            </aside>

            <main class="auth-main">
                <a href="{{ route('home') }}" class="auth-back">
                    <x-icon name="arrow-left" size="18" />
                    Volver al sitio
                </a>

                <div class="auth-card">
                    <h2 class="auth-card__title">{{ $authTitle }}</h2>
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
