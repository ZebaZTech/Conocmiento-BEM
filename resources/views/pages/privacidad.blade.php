@extends('layouts.public')

@section('content')
    <section class="section" id="privacidad">
      <div class="container container--narrow">
        <h1 class="section__title">Política de tratamiento de datos personales</h1>
        <p class="policy__meta">
          Versión {{ config('app.privacy_policy_version', '1.0') }} · Última actualización: 9 de noviembre de 2026
        </p>
        <p class="section__lead">
          Esta política explica qué datos personales recolecta Focus Work, para qué se usan, cómo se protegen y cómo
          puedes ejercer los derechos que te reconoce la Ley 1581 de 2012 y el Decreto 1377 de 2013 (Colombia).
        </p>

        <div class="policy">
          <section class="policy__block">
            <h2 class="policy__heading">Responsable del tratamiento</h2>
            <p class="policy__text">
              El responsable del tratamiento de tus datos personales es <strong>Sebastián Muñoz Bermúdez</strong>,
              responsable del proyecto académico <strong>Focus Work</strong>, disponible en el sitio
              <strong>focuswork.website</strong>. Puedes escribirle al correo
              <a href="mailto:hola@focuswork.com">hola@focuswork.com</a> para cualquier consulta sobre tus datos.
            </p>
          </section>

          <section class="policy__block">
            <h2 class="policy__heading">Datos que recolectamos</h2>
            <ul class="policy__list">
              <li>Nombre.</li>
              <li>Correo electrónico.</li>
              <li>Contraseña, almacenada siempre cifrada con un hash.</li>
              <li>Plan contratado.</li>
              <li>Tareas y sesiones de enfoque que creas en la aplicación.</li>
              <li>Mensajes enviados desde el formulario de contacto.</li>
            </ul>
          </section>

          <section class="policy__block">
            <h2 class="policy__heading">Finalidad del tratamiento</h2>
            <ul class="policy__list">
              <li>Crear y gestionar tu cuenta de usuario.</li>
              <li>Prestar el servicio de Focus Work (tareas, ciclos de enfoque y estadísticas).</li>
              <li>Generar las estadísticas de uso que ves en tu panel.</li>
              <li>Responder las consultas que envíes por el formulario de contacto.</li>
            </ul>
          </section>

          <section class="policy__block">
            <h2 class="policy__heading">Autorización</h2>
            <p class="policy__text">
              El tratamiento de tus datos se basa en la autorización previa, expresa e inequívoca que nos otorgas al
              marcar la casilla «Acepto la política de tratamiento de datos personales» al registrarte o al escribirnos.
              Guardamos la fecha en que aceptaste y la versión de esta política que aceptaste, de modo que quede
              constancia de tu autorización. Si la política cambia de forma sustancial, te pediremos una nueva
              aceptación.
            </p>
          </section>

          <section class="policy__block">
            <h2 class="policy__heading">Tus derechos como titular</h2>
            <ul class="policy__list">
              <li>Conocer los datos personales que tenemos sobre ti.</li>
              <li>Actualizar y rectificar tus datos cuando sean incorrectos o incompletos.</li>
              <li>Suprimir tus datos y eliminar tu cuenta cuando lo solicites.</li>
              <li>Revocar la autorización de tratamiento en cualquier momento.</li>
              <li>Presentar quejas ante la Superintendencia de Industria y Comercio (SIC).</li>
            </ul>
          </section>

          <section class="policy__block">
            <h2 class="policy__heading">Cómo ejercer tus derechos</h2>
            <p class="policy__text">
              Puedes ejercerlos de dos formas: escribiendo al correo
              <a href="mailto:hola@focuswork.com">hola@focuswork.com</a> o, si tienes cuenta, usando la opción de
              eliminación disponible en tu perfil, que suprime tus datos personales de forma inmediata. Responderemos
              tus solicitudes en un plazo máximo de quince (15) días hábiles.
            </p>
          </section>

          <section class="policy__block">
            <h2 class="policy__heading">Encargados y proveedores</h2>
            <p class="policy__text">
              Para operar el servicio usamos proveedores que pueden tratar datos personales en calidad de encargados:
            </p>
            <ul class="policy__list">
              <li><strong>Render</strong>: alojamiento de la aplicación.</li>
              <li><strong>Resend</strong>: envío de correos.</li>
              <li><strong>Backblaze B2</strong>: almacenamiento y respaldo de archivos.</li>
              <li><strong>Sentry</strong>: registro y monitoreo de errores.</li>
              <li><strong>Better Stack</strong>: monitoreo de disponibilidad.</li>
            </ul>
          </section>

          <section class="policy__block">
            <h2 class="policy__heading">Conservación y eliminación</h2>
            <p class="policy__text">
              Cuando eliminas tu cuenta, tus tareas y sesiones de enfoque se borran y tus testimonios y mensajes de
              contacto se anonimizan para que no puedan vincularse contigo. Se conserva únicamente un registro de
              auditoría, sin datos personales, que deja constancia de que la eliminación se realizó a solicitud del
              titular, conforme a lo permitido por la Ley 1581 de 2012.
            </p>
          </section>

          <section class="policy__block">
            <h2 class="policy__heading">Medidas de seguridad</h2>
            <ul class="policy__list">
              <li>Las contraseñas se almacenan cifradas con un algoritmo de hash; nadie puede leerlas.</li>
              <li>Todas las conexiones al sitio viajan por HTTPS.</li>
              <li>El acceso a los datos está restringido con controles de acceso y autenticación.</li>
            </ul>
          </section>

          <section class="policy__block">
            <h2 class="policy__heading">Vigencia</h2>
            <p class="policy__text">
              Esta política se mantiene vigente mientras el tratamiento de datos continúe y se actualizará cada vez
              que cambie la forma en que los tratamos. La última actualización es del
              <strong>9 de noviembre de 2026</strong> (versión {{ config('app.privacy_policy_version', '1.0') }}).
            </p>
          </section>
        </div>
      </div>
    </section>
@endsection
