<?php

namespace Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    private static Environment $twig;

    public static function init()
    {
        $loader = new FilesystemLoader(
            __DIR__ . '/../app/views'
        );

        self::$twig = new Environment(
            $loader,
            [
                'cache' => false,
                'debug' => true
            ]
        );
    }

    public static function render(
        string $template,
        array $data = []
    )
    {
        echo self::$twig->render(
            $template,
            $data
        );
    }
}