@extends('layouts.public')

@section('content')
    <section class="section section--alt" id="contacto">
      <div class="container container--narrow">
        <h2 class="section__title">Escríbenos</h2>

        <form class="form" novalidate method="POST" action="#">
          @csrf
          <div class="form__field">
            <label class="form__label" for="nombre">Nombre</label>
            <input class="form__input" id="nombre" name="nombre" type="text" required>
            <p class="form__error">Escribe tu nombre.</p>
          </div>

          <div class="form__field">
            <label class="form__label" for="email">Correo</label>
            <input class="form__input" id="email" name="email" type="email" required>
            <p class="form__error">Escribe un correo válido, por ejemplo nombre@correo.com.</p>
          </div>

          <div class="form__field">
            <label class="form__label" for="mensaje">Mensaje</label>
            <textarea class="form__input form__input--textarea" id="mensaje" name="mensaje" rows="4" required></textarea>
            <p class="form__error">Cuéntanos en qué podemos ayudarte.</p>
          </div>

          <button type="submit" class="button form__submit">Enviar mensaje</button>
        </form>
      </div>
    </section>
    <script>
      document.querySelector('.form').addEventListener('submit', function (e) {
        e.preventDefault();
        var todoOk = true;
        this.querySelectorAll('.form__field').forEach(function (campo) {
          var input = campo.querySelector('.form__input');
          var invalido = !input.checkValidity() || !input.value.trim();
          campo.classList.toggle('form__field--error', invalido);
          if (invalido) todoOk = false;
        });
        if (todoOk) {
          this.reset();
          alert('Mensaje enviado. Te respondemos pronto.');
        }
      });
    </script>
@endsection
