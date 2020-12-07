<?php

namespace core;

class Request
{
    public static function uri(): string
    {
        $uri = trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
            '/'
        );

        if (empty($uri)) {
            return '/';
        }

        return $uri;
    }

    public static function params(): array
    {
        $urlParams = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        parse_str($urlParams, $params);

        return $params;
    }

    public static function method(): string
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

    public static function extractFromPost(string $data): ?string
    {
        return $_POST[$data] ?? null;
    }
}
