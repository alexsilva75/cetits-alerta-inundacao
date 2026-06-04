<?php

namespace Repositories;

use Core\Database;

class Repository
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }
}