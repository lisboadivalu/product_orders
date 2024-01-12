<?php

namespace App\Domain\Order\UseCases;

use App\Domain\Order\Repositories\OrderRepository;
use Config\Database\Connection\DatabaseConnection;

class GetAllOrdersUseCase
{

    private OrderRepository $repository;
    public function __construct()
    {
        $connection = new DatabaseConnection('172.16.57.2', 'softexpert', 'postgres', '1234');
        $this->repository = new OrderRepository($connection);
    }

    public function handle(): array
    {
        return $this->repository->getAll();
    }
}