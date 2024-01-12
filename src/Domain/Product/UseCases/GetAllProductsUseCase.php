<?php

namespace App\Domain\Product\UseCases;

use App\Domain\Product\Repositories\ProductRepository;
use Config\Database\Connection\DatabaseConnection;

class GetAllProductsUseCase
{
    private ProductRepository $repository;
    public function __construct()
    {
        $connection = new DatabaseConnection('172.16.57.2', 'softexpert', 'postgres', '1234');
        $this->repository = new ProductRepository($connection);
    }

    public function handle(): array
    {
        return $this->repository->getAll();
    }
}