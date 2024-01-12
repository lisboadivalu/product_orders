<?php

namespace App\api\Controllers;

use App\Domain\Product\UseCases\CreateCategoryUseCase;
use App\Domain\Product\UseCases\CreateProductUseCase;
use App\Domain\Product\UseCases\DeleteProductUseCase;
use App\Domain\Product\UseCases\GetAllProductsUseCase;
use App\Domain\Product\UseCases\UpdateProductUseCase;
use App\Helpers\JsonResponse;
use App\Infrastructure\ControllerInterface;
use Controllers\Exception;
use PDOException;

class ProductController implements ControllerInterface
{
    public function getAll(): JsonResponse|null
    {
        try {
            $allProducts = new GetAllProductsUseCase();
            return JsonResponse::handle('Products ok', $allProducts->handle());
        } catch (Exception $exception) {
            return JsonResponse::handle($exception->getMessage(), 500);
        }
    }

    public function create(array $data): JsonResponse|null
    {
        try {
            $useCase = new CreateProductUseCase();
            $result = $useCase->handle($data);
            return JsonResponse::handle('product was created', $result);
        } catch (\TypeError $exception) {
            return JsonResponse::handle('product was not created', [], $exception->getMessage(), 500);
        } catch (PDOException $exception) {
            return JsonResponse::handle('product was not created', [], $exception->getMessage(), 500);
        } catch (Exception $exception) {
            return JsonResponse::handle($exception->getMessage(), 500);
        }
    }

    public function update($data): JsonResponse|null
    {
        try {
            $useCase = new UpdateProductUseCase();
            return JsonResponse::handle('The Product was updated',$useCase->handle($data));
        } catch (\TypeError $exception) {
            return JsonResponse::handle('product was not updated', [], $exception->getMessage(), 400);
        } catch (PDOException $exception) {
            return JsonResponse::handle('product was not updated', [], $exception->getMessage(), 400);
        } catch (Exception $exception) {
            return JsonResponse::handle($exception->getMessage(), 500);
        }
    }

    public function delete(array $data): JsonResponse|bool|null
    {
        try {
            $useCase = new DeleteProductUseCase();
            $useCase->handle($data);
            return JsonResponse::handle('The Product was deleted', [],'', 202);
        } catch (PDOException $exception) {
            return JsonResponse::handle('The product was not deleted', [], $exception->getMessage(), 400);
        } catch (Exception $exception) {
            return JsonResponse::handle('The product was not deleted', [], $exception->getMessage(), 500);
        }
    }


}