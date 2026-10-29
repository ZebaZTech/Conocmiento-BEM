@extends('layouts.public')

@section('content')
    <section class="section section--alt" id="contacto">
      <div class="container container--narrow">
        <h2 class="section__title">Escríbenos</h2>

        @if(session('status'))
          <p class="form__status" role="status">{{ session('status') }}</p>
        @endif

        <form class="form" novalidate method="POST" action="{{ route('contacto.store') }}">
          @csrf
          <div class="form__field @error('name') form__field--error @enderror">
            <label class="form__label" for="nombre">Nombre</label>
            <input class="form__input" id="nombre" name="name" type="text" value="{{ old('name') }}" required>
            <p class="form__error">@error('name'){{ $message }}@else Escribe tu nombre.@enderror</p>
          </div>

          <div class="form__field @error('email') form__field--error @enderror">
            <label class="form__label" for="email">Correo</label>
            <input class="form__input" id="email" name="email" type="email" value="{{ old('email') }}" required>
            <p class="form__error">@error('email'){{ $message }}@else Escribe un correo válido, por ejemplo nombre@correo.com.@enderror</p>
          </div>

          <div class="form__field @error('message') form__field--error @enderror">
            <label class="form__label" for="mensaje">Mensaje</label>
            <textarea class="form__input form__input--textarea" id="mensaje" name="message" rows="4" required>{{ old('message') }}</textarea>
            <p class="form__error">@error('message'){{ $message }}@else Cuéntanos en qué podemos ayudarte.@enderror</p>
          </div>

          <button type="submit" class="button form__submit">Enviar mensaje</button>
        </form>
      </div>
    </section>
    <script>
      document.querySelector('.form').addEventListener('submit', function (e) {
        var todoOk = true;
        this.querySelectorAll('.form__field').forEach(function (campo) {
          var input = campo.querySelector('.form__input');
          var invalido = !input.checkValidity() || !input.value.trim();
          campo.classList.toggle('form__field--error', invalido);
          if (invalido) todoOk = false;
        });
        if (!todoOk) {
          e.preventDefault();
        }
      });
    </script>
@endsection
