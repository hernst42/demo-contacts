<?php

require_once __DIR__ . '/vendor/autoload.php';
spl_autoload_register(function ($class) {
    if (strpos($class, 'hernst42\\') === 0) {
        require_once __DIR__ . '/src/' . str_replace('\\', '/', str_replace('hernst42\\', '', $class)) . '.php';
    }
});