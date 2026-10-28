@extends('layouts.public')

@section('content')
    <section class="section" id="planes">
      <div class="container">
        <h2 class="section__title">Planes</h2>
        <p class="section__lead">Empieza gratis y cambia de plan cuando lo necesites.</p>

        <div class="section__grid section__grid--3">
          <article class="pricing-card">
            <h3 class="pricing-card__name">Gratis</h3>
            <p class="pricing-card__price">$0<span class="pricing-card__period">/mes</span></p>
            <ul class="pricing-card__list">
              <li class="pricing-card__item">Temporizador de ciclos</li>
              <li class="pricing-card__item">Estadísticas de 7 días</li>
              <li class="pricing-card__item pricing-card__item--off">Modo sin distracciones</li>
            </ul>
            <a href="{{ route('contacto') }}" class="button button--outline">Empezar</a>
          </article>

          <article class="pricing-card pricing-card--recommended">
            <span class="pricing-card__badge">Más elegido</span>
            <h3 class="pricing-card__name">Pro</h3>
            <p class="pricing-card__price">$6<span class="pricing-card__period">/mes</span></p>
            <ul class="pricing-card__list">
              <li class="pricing-card__item">Temporizador de ciclos</li>
              <li class="pricing-card__item">Estadísticas ilimitadas</li>
              <li class="pricing-card__item">Modo sin distracciones</li>
            </ul>
            <a href="{{ route('contacto') }}" class="button">Empezar</a>
          </article>

          <article class="pricing-card">
            <h3 class="pricing-card__name">Equipos</h3>
            <p class="pricing-card__price">$4<span class="pricing-card__period">/usuario</span></p>
            <ul class="pricing-card__list">
              <li class="pricing-card__item">Todo lo de Pro</li>
              <li class="pricing-card__item">Panel de equipo</li>
              <li class="pricing-card__item">Soporte prioritario</li>
            </ul>
            <a href="{{ route('contacto') }}" class="button button--outline">Empezar</a>
          </article>
        </div>
      </div>
    </section>
@endsection
