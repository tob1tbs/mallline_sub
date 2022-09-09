<?php
return [
    'path' => base_path() . '/app/Modules',
    'base_namespace' => 'App\Modules',

    'groupMidleware' => [
        'web' => ['auth', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],

    'modules' => [
        'Users',
        'Main',
        'Builder',
        'Products',
        'Dashboard',
        'Parameters',
        'Customers',
        'Vendors',
    ]
];