<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration
    |--------------------------------------------------------------------------
    |
    | This file is for configuring the connection to your Cloudinary service.
    |
    */

    'url' => env('CLOUDINARY_URL'),  // Leemos la URL de configuración desde el archivo .env

    /*
    |--------------------------------------------------------------------------
    | Default Transformation
    |--------------------------------------------------------------------------
    |
    | You can set a default image transformation here that will be applied
    | to all images uploaded to Cloudinary.
    |
    */

    'transformation' => [
        'width' => 500,
        'height' => 500,
        'crop' => 'fill',
    ],
];
