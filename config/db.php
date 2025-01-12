<?php

return [
    'db' => [
        'driver' => 'mysql',
        'dbname' => 'shopaholic',
        'host' => '127.0.0.1',

    ],
    'user' => 'root',
    'password' => '[password]',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS
    ]
];