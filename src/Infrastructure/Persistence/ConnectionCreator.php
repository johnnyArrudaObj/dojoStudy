<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    public static function createConnection(): PDO
    {
        $pathDataBase = __DIR__ . '/../../../dataBase.sqlite';
        $pdo = new \PDO("sqlite:$pathDataBase");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }
}
