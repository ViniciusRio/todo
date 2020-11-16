<?php

namespace core;

class Request
{
    public static function uri()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position === false)
        {
            return $path;
        }

        return substr($path, 0, $position);
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function sanitizeData()
    {
        // htmlspecialchars
        /**
         * <?php foreach($n as $v) : ?>
         *
         * <?php endforeach; ?>
         */
        $dataSanitize = [];

        if (self::method() === 'get') {
            foreach ($_GET as $key => $value) {
                $dataSanitize[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
    }

}