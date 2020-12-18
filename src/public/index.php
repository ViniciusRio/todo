<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ERROR);

    spl_autoload_register(function ($classPath) {
        $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $classPath);

        include __DIR__ . '/..' . '/' . $classPath . '.php';
    });

    defined('DIR_BASE_NAME') || define('DIR_BASE_NAME', dirname(__DIR__));

    require DIR_BASE_NAME . '/core/helpers.php';

    use core\Router;
    use core\Request;

    Router::load(DIR_BASE_NAME . '/app/routes.php')
            ->direct(Request::uri(), Request::method());
