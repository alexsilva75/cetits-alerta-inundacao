<?php

namespace Core;

use PDO;

class Database
{
    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new PDO(
                "mysql:host=localhost;dbname=alerta",
                "root",
                ""
            );

            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$instance;
    }
}
