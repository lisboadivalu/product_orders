<?php

namespace App\Infrastructure;

use App\Application\Model\Model;
use App\Helpers\SetColumnParamUpdate;
use Carbon\Carbon;
use Config\Database\Connection\DatabaseConnection;
use PDO;
use PDOException;

abstract class AbstractRepository
{
    public string $table;
    public string $item;

    protected PDO $connection;

    public function __construct(DatabaseConnection $connection){
        $this->connection = $connection;
    }

    public function update(array $data) {
        $validatedId = intval($data['id']);

        $query = "SELECT * FROM $this->table WHERE id = $validatedId";
        $id = $this->connection->query($query)->fetch(PDO::FETCH_ASSOC);

        if(!$id) throw new PDOException("The $this->item not found");

        unset($data['id']);
        $data['updated_at'] = Carbon::now('GMT-3');
        $columns = new SetColumnParamUpdate($data);

        $stmt = $this->connection->prepare("UPDATE $this->table SET $columns WHERE id = $validatedId");
        $stmt->execute();

        return [];
    }

    public function delete(array $data)
    {
        $validatedId = intval($data['id']);
        $findIdQuery = "SELECT * FROM $this->table WHERE id = $validatedId";

        $id = $this->connection->query($findIdQuery)->fetch(PDO::FETCH_ASSOC);

        if(!$id) throw new PDOException("The $this->item not found");

        $deleteQuery = "DELETE FROM $this->table WHERE id = :id";

        $stmt = $this->connection->prepare($deleteQuery);
        $stmt->bindValue(':id', $validatedId, PDO::PARAM_INT);
        $stmt->execute();

        return true;
    }
}