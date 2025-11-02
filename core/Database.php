<?php
namespace Core;

use PDO;
use PDOException;

class Database
{
    private $connection;

    public function __construct(array $config)
    {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            $config['host'] ?? 'localhost',
            $config['dbname'] ?? '',
            $config['charset'] ?? 'utf8mb4'
        );

        try {
            $this->connection = new PDO(
                $dsn,
                $config['username'] ?? 'root',
                $config['password'] ?? '',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_MULTI_STATEMENTS => false
                ]
            );
        } catch (PDOException $e) {
            die(json_encode([
                'status' => 'error',
                'message' => 'Database connection failed: ' . $e->getMessage()
            ]));
        }
    }

    public function query(string $sql, array $params = [])
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

        foreach ($params as $key => $value) {
            $stmt->bindValue(":$key", $value, $value === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        }

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Liberar el cursor y evitar bloqueos en futuros CALL
        do {
            $stmt->closeCursor();
        } while ($stmt->nextRowset());

        return $results ?: [];
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
