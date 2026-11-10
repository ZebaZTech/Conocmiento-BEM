<section>
    <header class="mb-3">
        <h2 class="h4 mb-1">
            Tus datos personales
        </h2>

        <p class="text-secondary mb-0">
            Conforme a la Ley 1581 de 2012 puedes conocer, actualizar, rectificar y suprimir tus datos personales,
            así como revocar la autorización de tratamiento.
        </p>
    </header>

    <dl class="row mb-0">
        <dt class="col-sm-5 col-lg-4">Aceptación de la política</dt>
        <dd class="col-sm-7 col-lg-8">
            @if ($user->privacy_accepted_at)
                {{ $user->privacy_accepted_at->format('d/m/Y H:i') }}
                (versión {{ $user->privacy_policy_version ?? config('app.privacy_policy_version', '1.0') }})
            @else
                Pendiente de aceptar.
            @endif
        </dd>

        <dt class="col-sm-5 col-lg-4">Política de privacidad</dt>
        <dd class="col-sm-7 col-lg-8">
            <a href="{{ route('privacidad') }}" target="_blank" rel="noopener">Ver la política de tratamiento de datos personales</a>
        </dd>

        <dt class="col-sm-5 col-lg-4">Ejercer tus derechos</dt>
        <dd class="col-sm-7 col-lg-8">
            Escríbenos a <a href="mailto:hola@focuswork.com">hola@focuswork.com</a> para conocer, actualizar o
            rectificar tus datos, o usa el botón «Eliminar cuenta» de esta página para suprimirlos de forma
            permanente.
        </dd>
    </dl>
</section>
