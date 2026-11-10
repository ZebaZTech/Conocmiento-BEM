<x-mail::message>
# ¡Hola, {{ $user->name }}!

Bienvenido a Focus Work. Tu cuenta ya está lista y con ella puedes:

- Crear y organizar tus **tareas** por categorías.
- Trabajar en **ciclos de enfoque** de 25 minutos con descansos de 5.
- Consultar tus **estadísticas** para saber en qué momentos del día rindes más.

<x-mail::button :url="route('dashboard')">
Ir a mi panel
</x-mail::button>

Gracias,<br>
{{ config('app.name') }}

@if (Route::has('privacidad'))
<x-slot:subcopy>
Consulta nuestra <a href="{{ route('privacidad') }}">política de tratamiento de datos personales</a>.
</x-slot:subcopy>
@endif
</x-mail::message>
