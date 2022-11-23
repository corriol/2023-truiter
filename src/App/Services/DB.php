<?php

namespace App\Services;

use PDO;

/**
 * https://phpdelusions.net/pdo/pdo_wrapper#class
 */

class DB
{
    private PDO $pdo;

    public function __construct($db, $username = NULL, $password = NULL, $host = '127.0.0.1', $port = 3306, $options = [])
    {
        $default_options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        $options = array_replace($default_options, $options);
        $dsn = "mysql:host=$host;dbname=$db;port=$port;charset=utf8mb4";

        try {
            $this->pdo = new \PDO($dsn, $username, $password, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function run($sql, $args = NULL): \PDOStatement
    {
        if (!$args) {
            return $this->pdo->query($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    public function getPDO(): PDO {
        return $this->pdo;
    }
}