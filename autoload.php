<?php

spl_autoload_register(function($class) {
    if (file_exists(__DIR__ . '/app/Core/' . $class . '.php')) {
        require __DIR__ . '/app/Core/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/app/Controllers/' . $class . '.php')) {
        require __DIR__ . '/app/Controllers/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/app/Models/' . $class . '.php')) {
        require __DIR__ . '/app/Models/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/app/Services/' . $class . '.php')) {
        require __DIR__ . '/app/Services/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/app/Repositories/' . $class . '.php')) {
        require __DIR__ . '/app/Repositories/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/app/Core/Traits/' . $class . '.php')) {
        require __DIR__ . '/app/Core/Traits/' . $class . '.php';
    }
});