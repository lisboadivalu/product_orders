<?php

namespace Config\Database\Connection;

use PDO;
class DatabaseConnection
{

    private PDO $connection;
    public function __construct(
        private readonly string $host,
        private readonly string $db_name,
        private readonly string $username,
        private readonly string $password
    )
    {
    }

    public function getInstance(): PDO
    {
        try {
            $this->connection = new PDO(
                "pgsql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password
            );
        } catch (PDOException $exception) {
            echo 'Error when trying to connect with the DB: ' . $exception->getMessage();
        }

        return $this->connection;
    }
}

