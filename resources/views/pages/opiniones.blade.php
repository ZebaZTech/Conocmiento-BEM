@extends('layouts.public')

@section('content')
    <section class="section section--alt" id="testimonios">
      <div class="container">
        <h2 class="section__title">Lo que dicen quienes ya lo usan</h2>

        <div class="section__grid section__grid--3">
          @php $testimonials = \App\Models\Testimonial::all(); @endphp
          @foreach($testimonials as $testimonial)
            @php
              $testimonialClass = 'testimonial';
              $avatarClass = 'avatar';
              if ($testimonial->variant === 'highlight') {
                  $testimonialClass = 'testimonial testimonial--highlight';
                  $avatarClass = 'avatar avatar--large';
              } elseif ($testimonial->variant === 'compact') {
                  $testimonialClass = 'testimonial testimonial--compact';
                  $avatarClass = 'avatar avatar--alt';
              }
            @endphp
            <blockquote class="{{ $testimonialClass }}">
              <p class="testimonial__text">{{ $testimonial->text }}</p>
              <footer class="testimonial__author">
                <span class="{{ $avatarClass }}">{{ $testimonial->initials }}</span>
                <span class="testimonial__meta">
                  <strong class="testimonial__name">{{ $testimonial->name }}</strong>
                  <span class="testimonial__role">{{ $testimonial->role }}</span>
                </span>
              </footer>
            </blockquote>
          @endforeach
        </div>
      </div>
    </section>
@endsection
