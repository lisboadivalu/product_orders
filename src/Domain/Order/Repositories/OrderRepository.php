<?php

namespace App\Domain\Order\Repositories;

use App\Infrastructure\AbstractRepository;
use Config\Database\Connection\DatabaseConnection;
use PDO;
use PDOException;

class OrderRepository extends AbstractRepository
{
    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection->getInstance();
        $this->table = 'orders';
        $this->item = 'order';
    }

    public function getAll(): array
    {
        $query = "
            SELECT
	            ANY_VALUE(p.title) as product_title,
	            COUNT(o.id) as total_sold,
	            round((ANY_VALUE(c.tax_percentage) * SUM(p.price) / 100), 2) as total_tax_paid
            FROM
	            orders o
            LEFT JOIN categories c ON
	            c.id = o.category_id
            LEFT JOIN products p ON
	            p.id = o.product_id
            GROUP BY
	            o.product_id;
        ";

        $result = $this->connection
            ->query($query)
            ->fetchAll(PDO::FETCH_ASSOC);

        if(!$result) return [];

        return $result;
    }

    public function create(array $data)
    {
        try {
            $this->connection->beginTransaction();
            $query = "INSERT INTO $this->table (category_id, product_id) VALUES (:category_id, :product_id)";

            $stmt = $this->connection->prepare($query);

            $stmt->bindValue(':category_id', $data['category_id'], PDO::PARAM_INT);
            $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
            $stmt->execute();

            $this->connection->commit();

            $id = intval($this->connection->lastInsertId());

            return $this->connection->query("SELECT * FROM orders WHERE id = $id")
                ->fetch(PDO::FETCH_ASSOC);
        } catch (\TypeError $exception) {
            return $exception->getMessage();
            $this->connection0->rollback();
        }
    }
}