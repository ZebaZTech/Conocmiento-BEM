<?php

it('renders each public page', function (string $path) {
    $this->get($path)->assertOk();
})->with([
    '/',
    '/caracteristicas',
    '/opiniones',
    '/planes',
    '/contacto',
    '/login',
    '/register',
]);
