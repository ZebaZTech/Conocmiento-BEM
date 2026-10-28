<footer class="footer">
    <div class="footer__inner container">
        <div class="footer__col">
            <a href="{{ route('home') }}" class="logo logo--light">
                <span class="logo__mark">⏱</span>
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
        </ul>

        <ul class="social">
            <li class="social__item"><a href="#" class="social__link" aria-label="Instagram">IG</a></li>
            <li class="social__item"><a href="#" class="social__link" aria-label="LinkedIn">IN</a></li>
            <li class="social__item"><a href="#" class="social__link" aria-label="X">X</a></li>
        </ul>
    </div>

    <p class="footer__copy">© 2026 Focus Work. Todos los derechos reservados.</p>
</footer>
