<?php

namespace App\Domain\Product\Repositories;

use App\Infrastructure\AbstractRepository;
use Config\Database\Connection\DatabaseConnection;
use PDO;
use PDOException;

class ProductRepository extends AbstractRepository
{

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection->getInstance();
        $this->table = 'products';
        $this->item = 'product';
    }

    public function getAll(): array
    {
        $query = "SELECT 
                    p.id, 
                    c.title category_title,
                    p.category_id,
                    p.title, 
                    p.price, 
                    p.created_at,
                    p.updated_at
                FROM $this->table as p 
                INNER JOIN categories as c on c.id = p.category_id
                ORDER BY id ASC";
        $result = $this->connection
        ->query($query)
            ->fetchAll(PDO::FETCH_ASSOC);

        if(!$result) return [];

        return $result;
    }

    public function create(array $data)
    {
        $validatedId = intval($data['category_id']);

        $query = "SELECT * FROM categories WHERE id = $validatedId";
        $id = $this->connection->query($query)->fetch(PDO::FETCH_ASSOC);

        if(!$id) throw new PDOException('category_id not found');

        try {
            $this->connection->beginTransaction();
            $query = "INSERT INTO $this->table (category_id, title, price) VALUES (:category_id, :title, :price)";

            $stmt = $this->connection->prepare($query);

            $stmt->bindValue(':category_id', $data['category_id'], PDO::PARAM_INT);
            $stmt->bindValue(':title', $data['title']);
            $stmt->bindValue(':price', $data['price']);
            $stmt->execute();

            $this->connection->commit();

            $id = intval($this->connection->lastInsertId());

            return $this->connection->query("SELECT * FROM products WHERE id = $id")
                ->fetch(PDO::FETCH_ASSOC);
        } catch (\TypeError $exception) {
            return $exception->getMessage();
            $this->connection0->rollback();
        }
    }

}