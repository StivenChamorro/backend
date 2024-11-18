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

    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
    'api_key' => env('CLOUDINARY_API_KEY'),
    'api_secret' => env('CLOUDINARY_API_SECRET'),
    'secure' => true,


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
