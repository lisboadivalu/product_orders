<?php

namespace App\api\Controllers;

use App\Domain\Order\UseCases\CreateOrderUseCase;
use App\Domain\Order\UseCases\DeleteOrderUseCase;
use App\Domain\Order\UseCases\GetAllOrdersUseCase;
use App\Domain\Order\UseCases\UpdateOrderUseCase;
use App\Helpers\JsonResponse;
use App\Infrastructure\ControllerInterface;
use PDOException;

class OrderController implements ControllerInterface
{

    public function getAll(): JsonResponse|null
    {
        try {

            $useCase = new GetAllOrdersUseCase();

            return JsonResponse::handle('teste', $useCase->handle());
        } catch (\Exception $exception) {
            return JsonResponse::handle('The order was not created', [], $exception->getMessage(), 500);
        }
    }

    public function create(array $data): JsonResponse|null
    {
        try {
            $useCase = new CreateOrderUseCase();
            $result = $useCase->handle($data);
            return JsonResponse::handle('The order was created', $result);
        } catch (\TypeError $exception) {
            return JsonResponse::handle('The order was not created', [], $exception->getMessage(), 500);
        } catch (PDOException $exception) {
            return JsonResponse::handle('The order was not created', [], $exception->getMessage(), 500);
        }
    }

    public function update(array $data): JsonResponse|null
    {
        try {
            $useCase = new UpdateOrderUseCase();
            return JsonResponse::handle('The order was updated',$useCase->handle($data));
        } catch (\TypeError $exception) {
            return JsonResponse::handle('TThe order was not updated', [], $exception->getMessage(), 400);
        } catch (PDOException $exception) {
            return JsonResponse::handle('The order was not updated', [], $exception->getMessage(), 400);
        } catch (Exception $exception) {
            return JsonResponse::handle($exception->getMessage(), 500);
        }
    }

    public function delete(array $data): JsonResponse|bool|null
    {
        try {
            $useCase = new DeleteOrderUseCase();
            $useCase->handle($data);
            return JsonResponse::handle('The order was deleted', [],'', 202);
        } catch (PDOException $exception) {
            return JsonResponse::handle('The order was not deleted', [], $exception->getMessage(), 400);
        } catch (Exception $exception) {
            return JsonResponse::handle('The order was not deleted', [], $exception->getMessage(), 500);
        }
    }
}