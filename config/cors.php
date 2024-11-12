<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['v1/*'], // Aplica CORS a todas las rutas bajo el prefijo 'v1'

    'allowed_methods' => ['*'], // Permite todos los métodos HTTP

    'allowed_origins' => [
        'http://localhost:8000', 
        'http://127.0.0.1:8000'
    ], // Permite solo estos orígenes para solicitudes de desarrollo local

    'allowed_origins_patterns' => [], // Opcional: Usa patrones si necesitas coincidencias parciales

    'allowed_headers' => ['*'], // Permite todos los encabezados

    'exposed_headers' => [], // Puedes especificar los encabezados que deseas exponer al cliente

    'max_age' => 0, // Controla el tiempo de vida de la política en caché

    'supports_credentials' => false, // Generalmente false cuando usas JWT
];
