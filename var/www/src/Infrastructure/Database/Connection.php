<?php

namespace App\Infrastructure\Database;

final class Connection
{
    public static function get(): \PDO
    {
        static $pdo;
        
        if ($pdo === null) {
            $pdo = new \PDO(
                sprintf('mysql:host=%s;dbname=%s', getenv('MYSQL_HOST'), getenv('MYSQL_DATABASE')),
                getenv('MYSQL_USER'),
                getenv('MYSQL_PASSWORD'),
                [
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'utf8mb4\''
                ]
            );
        }
        
        return $pdo;
    }
}
