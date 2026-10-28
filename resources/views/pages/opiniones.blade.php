@extends('layouts.public')

@section('content')
    <section class="section section--alt" id="testimonios">
      <div class="container">
        <h2 class="section__title">Lo que dicen quienes ya lo usan</h2>

        <div class="section__grid section__grid--3">
          <blockquote class="testimonial testimonial--highlight">
            <p class="testimonial__text">Pasé de distraerme cada diez minutos a terminar mis entregas antes del viernes.</p>
            <footer class="testimonial__author">
              <span class="avatar avatar--large">LM</span>
              <span class="testimonial__meta">
                <strong class="testimonial__name">Laura Mejía</strong>
                <span class="testimonial__role">Estudiante de ingeniería</span>
              </span>
            </footer>
          </blockquote>

          <blockquote class="testimonial">
            <p class="testimonial__text">Las estadísticas me mostraron que rindo más por la mañana. Reorganicé mi agenda.</p>
            <footer class="testimonial__author">
              <span class="avatar">JR</span>
              <span class="testimonial__meta">
                <strong class="testimonial__name">Juan Restrepo</strong>
                <span class="testimonial__role">Diseñador freelance</span>
              </span>
            </footer>
          </blockquote>

          <blockquote class="testimonial testimonial--compact">
            <p class="testimonial__text">Usamos Focus Work en todo el equipo y las reuniones bajaron a la mitad.</p>
            <footer class="testimonial__author">
              <span class="avatar avatar--alt">SG</span>
              <span class="testimonial__meta">
                <strong class="testimonial__name">Sara Gómez</strong>
                <span class="testimonial__role">Líder de producto</span>
              </span>
            </footer>
          </blockquote>
        </div>
      </div>
    </section>
@endsection
