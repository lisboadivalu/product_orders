<?php

namespace App\Infrastructure;

use App\Helpers\JsonResponse;

interface ControllerInterface
{
    public function getAll(): JsonResponse|null;
    public function create(array $data): JsonResponse|null;
    public function update(array $data): JsonResponse|null;
    public function delete(array $data): JsonResponse|bool|null;
}