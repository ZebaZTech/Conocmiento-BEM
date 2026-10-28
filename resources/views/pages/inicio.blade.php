@extends('layouts.public')

@section('content')
    <section class="hero" id="inicio">
      <div class="hero__content container">
        <h1 class="hero__title">Trabaja en ciclos de 25 minutos y termina más en menos tiempo.</h1>
        <p class="hero__subtitle">Focus Work divide tu jornada en bloques de enfoque y descanso para que avances sin agotarte.</p>
        <a href="{{ route('planes') }}" class="button button--large">Probar Focus Work</a>
      </div>
    </section>
    <section class="section" id="caracteristicas-resumen">
      <div class="container">
        <h2 class="section__title">Todo lo que necesitas para enfocarte</h2>
        <p class="section__lead">Tres herramientas simples para que cada sesión de trabajo cuente.</p>
        <div class="section__grid section__grid--3">
          <article class="feature-card feature-card--featured">
            <span class="feature-card__icon" aria-hidden="true">⏱</span>
            <h3 class="feature-card__title">Temporizador de ciclos</h3>
            <p class="feature-card__text">25 minutos de trabajo y 5 de descanso, con aviso sonoro al cambiar de fase. Tú ajustas la duración.</p>
          </article>
          <article class="feature-card">
            <span class="feature-card__icon" aria-hidden="true">📊</span>
            <h3 class="feature-card__title">Estadísticas de tu día</h3>
            <p class="feature-card__text">Mira cuántos ciclos completaste y en qué horas rindes más.</p>
          </article>
          <article class="feature-card">
            <span class="feature-card__icon" aria-hidden="true">🔕</span>
            <h3 class="feature-card__title">Modo sin distracciones</h3>
            <p class="feature-card__text">Silencia las notificaciones mientras dura cada ciclo de enfoque.</p>
          </article>
        </div>
      </div>
    </section>
@endsection
