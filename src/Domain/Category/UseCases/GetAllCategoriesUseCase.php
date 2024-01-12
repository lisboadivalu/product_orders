<?php

namespace App\Domain\Category\UseCases;

use App\Domain\Category\Repositories\CategoryRepository;
use Config\Database\Connection\DatabaseConnection;

class GetAllCategoriesUseCase
{
    private CategoryRepository $repository;
    public function __construct()
    {
        $connection = new DatabaseConnection('172.16.57.2', 'softexpert', 'postgres', '1234');
        $this->repository = new CategoryRepository($connection);
    }

    public function handle(): array
    {
        return $this->repository->getAll();
    }
}