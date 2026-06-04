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
        self::$twig->addGlobal(
            'session',
            $_SESSION
        );  

        self::$twig->addGlobal(
            'flash',
            $_SESSION['flash'] ?? null
        );

        echo self::$twig->render(
            $template,
            $data
        );

        unset($_SESSION['flash']);
    }
}