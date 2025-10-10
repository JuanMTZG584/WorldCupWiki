<?php
namespace Core;

use PDO;
use PDOException;

class Database
{
    private $connection;

    public function __construct($config)
    {
        $connectionString = "mysql:" . http_build_query($config, '', ';');

        try {
            $this->connection = new PDO($connectionString, $config['username'], $config['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }

    }

    //Helping methods
    public function query($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function callProcedure(string $procedureName, array $params = []): array
    {
        $placeholders = implode(', ', array_map(fn($p) => ":$p", array_keys($params)));
        $sql = "CALL {$procedureName}({$placeholders})";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}