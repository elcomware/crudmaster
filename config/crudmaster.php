<?php


return [
    'ui' => 'inertia', // inertia, blade, none
    'default_namespace' => 'App\\Http\\Controllers',
    'response_class' => 'App\\Http\\Responses\\SuccessResponse::class',
    'routes' => [
        'prefix' => 'admin',
        'middleware' => ['web', 'auth'],
    ],
];
