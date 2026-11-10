<footer class="footer">
    <div class="footer__inner container">
        <div class="footer__col">
            <a href="{{ route('home') }}" class="logo logo--light">
                <x-application-logo class="logo__mark" aria-hidden="true" />
                <span class="logo__text">Focus Work</span>
            </a>
            <address class="footer__contact">
                hola@focuswork.com<br>
                +57 300 000 0000
            </address>
        </div>

        <ul class="footer__links">
            <li><a href="{{ route('caracteristicas') }}" class="footer__link">Características</a></li>
            <li><a href="{{ route('planes') }}" class="footer__link">Planes</a></li>
            <li><a href="{{ route('contacto') }}" class="footer__link">Contacto</a></li>
            <li><a href="{{ route('privacidad') }}" class="footer__link">Política de privacidad</a></li>
        </ul>

        <ul class="social">
            <li class="social__item"><span class="social__link" aria-label="Instagram">IG</span></li>
            <li class="social__item"><span class="social__link" aria-label="LinkedIn">IN</span></li>
            <li class="social__item"><span class="social__link" aria-label="X">X</span></li>
        </ul>
    </div>

    <p class="footer__copy">© 2026 Focus Work. Todos los derechos reservados.</p>
</footer>
