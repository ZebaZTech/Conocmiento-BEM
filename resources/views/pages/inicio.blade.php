@extends('layouts.public')

@section('content')
    <section class="hero" id="inicio">
      <div class="hero__content container">
        <div class="hero__body">
          <h1 class="hero__title">Trabaja en ciclos de 25 minutos y termina más en menos tiempo.</h1>
          <p class="hero__subtitle">Focus Work divide tu jornada en bloques de enfoque y descanso para que avances sin agotarte.</p>
          <ul class="hero__points">
            <li class="hero__point"><x-icon name="timer" size="20" /> 25 min de enfoque</li>
            <li class="hero__point"><x-icon name="coffee" size="20" /> 5 min de descanso</li>
            <li class="hero__point"><x-icon name="shield" size="20" /> Cero distracciones</li>
          </ul>
          <a href="{{ route('planes') }}" class="button button--large">Probar Focus Work</a>
        </div>
        <div class="hero__visual">
          <svg class="hero__timer" viewBox="0 0 320 320" role="img" aria-hidden="true" focusable="false">
            <circle cx="160" cy="160" r="143" fill="none" stroke="rgba(255, 255, 255, 0.35)" stroke-width="3" stroke-linecap="round" stroke-dasharray="1 30" />
            <circle cx="160" cy="160" r="120" fill="rgba(255, 255, 255, 0.14)" stroke="rgba(255, 255, 255, 0.22)" stroke-width="14" />
            <circle cx="160" cy="160" r="120" fill="none" stroke="#f4c430" stroke-width="14" stroke-linecap="round" stroke-dasharray="565.5 754" transform="rotate(-90 160 160)" />
            <circle cx="160" cy="160" r="100" fill="none" stroke="rgba(255, 255, 255, 0.2)" stroke-width="1" stroke-dasharray="4 8" />
            <text x="160" y="174" text-anchor="middle" fill="#ffffff" font-family="Arial, sans-serif" font-size="54" font-weight="700" letter-spacing="2">25:00</text>
            <text x="160" y="208" text-anchor="middle" fill="rgba(255, 255, 255, 0.75)" font-family="Arial, sans-serif" font-size="13" font-weight="700" letter-spacing="4">ENFOQUE</text>
          </svg>
        </div>
      </div>
    </section>
    <section class="section" id="caracteristicas-resumen">
      <div class="container">
        <h2 class="section__title">Todo lo que necesitas para enfocarte</h2>
        <p class="section__lead">Tres herramientas simples para que cada sesión de trabajo cuente.</p>
        <div class="section__grid section__grid--3">
          <article class="feature-card feature-card--featured">
            <span class="feature-card__icon" aria-hidden="true"><x-icon name="timer" size="32" /></span>
            <h3 class="feature-card__title">Temporizador de ciclos</h3>
            <p class="feature-card__text">25 minutos de trabajo y 5 de descanso, con aviso sonoro al cambiar de fase. Tú ajustas la duración.</p>
          </article>
          <article class="feature-card">
            <span class="feature-card__icon" aria-hidden="true"><x-icon name="chart" size="32" /></span>
            <h3 class="feature-card__title">Estadísticas de tu día</h3>
            <p class="feature-card__text">Mira cuántos ciclos completaste y en qué horas rindes más.</p>
          </article>
          <article class="feature-card">
            <span class="feature-card__icon" aria-hidden="true"><x-icon name="shield" size="32" /></span>
            <h3 class="feature-card__title">Modo sin distracciones</h3>
            <p class="feature-card__text">Silencia las notificaciones mientras dura cada ciclo de enfoque.</p>
          </article>
        </div>
      </div>
    </section>
@endsection
