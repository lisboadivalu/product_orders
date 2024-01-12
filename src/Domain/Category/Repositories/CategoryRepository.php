<?php

namespace App\Domain\Category\Repositories;

use App\Infrastructure\AbstractRepository;
use Config\Database\Connection\DatabaseConnection;
use PDO;
use PDOException;
use TypeError;

class CategoryRepository extends AbstractRepository
{
    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection->getInstance();
        $this->table = 'categories';
        $this->item = 'category';
    }

    public function getAll(): array
    {
        $result = $this->connection
            ->query("SELECT * FROM $this->table ORDER BY id ASC")
            ->fetchAll(PDO::FETCH_ASSOC);

        if(!$result) return [];

        return $result;
    }

    public function create(array $data)
    {
        try {
            $this->connection->beginTransaction();
            $query = "INSERT INTO $this->table (title, tax_percentage) VALUES (:title, :tax_percentage)";

            $stmt = $this->connection->prepare($query);

            $stmt->bindValue(':title', $data['title']);
            $stmt->bindValue(':tax_percentage', $data['tax_percentage'], PDO::PARAM_INT);
            $stmt->execute();

            $this->connection->commit();

            $id = intval($this->connection->lastInsertId());

            return $this->connection->query("SELECT * FROM $this->table WHERE id = $id")
                ->fetch(PDO::FETCH_ASSOC);

        } catch (TypeError $exception) {
            return $exception->getMessage();
            $this->connection0->rollback();
        } catch (PDOException $exception) {
            return $exception->getMessage();
            $this->connection0->rollback();
        }
    }
}