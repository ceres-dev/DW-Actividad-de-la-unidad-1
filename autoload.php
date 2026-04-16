<?php

spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/domain/Model/',
        __DIR__ . '/domain/Repository/',
        __DIR__ . '/application/UseCase/',
        __DIR__ . '/infrastructure/Persistence/',
        __DIR__ . '/infrastructure/',
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});