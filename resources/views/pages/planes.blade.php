@extends('layouts.public')

@section('content')
    <section class="section" id="planes">
      <div class="container">
        <h2 class="section__title">Planes</h2>
        <p class="section__lead">Empieza gratis y cambia de plan cuando lo necesites.</p>

        <div class="section__grid section__grid--3">
          @php $plans = \App\Models\Plan::all(); @endphp
          @foreach($plans as $plan)
            <article class="pricing-card {{ $plan->featured ? 'pricing-card--recommended' : '' }}">
              @if($plan->featured)
                <span class="pricing-card__badge">Más elegido</span>
              @endif
              <h3 class="pricing-card__name">{{ $plan->name }}</h3>
                  <p class="pricing-card__price">${{ (float) $plan->price }}<span class="pricing-card__period">/{{ $plan->period }}</span></p>
              <ul class="pricing-card__list">
                @foreach((array)$plan->features as $feature)
                  <li class="pricing-card__item">{{ $feature }}</li>
                @endforeach
                @foreach((array)($plan->excluded_features ?? []) as $excluded)
                  <li class="pricing-card__item pricing-card__item--off">{{ $excluded }}</li>
                @endforeach
              </ul>
              <a href="{{ route('contacto') }}" class="button {{ $plan->featured ? '' : 'button--outline' }}">Empezar</a>
            </article>
          @endforeach
        </div>
      </div>
    </section>
@endsection
