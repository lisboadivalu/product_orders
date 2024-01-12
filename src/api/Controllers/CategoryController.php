<?php

namespace App\api\Controllers;

use App\Domain\Category\UseCases\DeleteCategoryUseCase;
use App\Domain\Category\UseCases\GetAllCategoriesUseCase;

use App\Domain\Category\UseCases\CreateCategoryUseCase;
use App\Domain\Category\UseCases\UpdateCategoryUseCase;
use App\Domain\Product\UseCases\DeleteProductUseCase;
use App\Domain\Product\UseCases\UpdateProductUseCase;
use App\Helpers\JsonResponse;
use App\Infrastructure\ControllerInterface;
use Exception;

class CategoryController implements ControllerInterface
{
    public function getAll(): JsonResponse|null
    {
        try {
            $allCategories = new GetAllCategoriesUseCase();

            return JsonResponse::handle('Categories ok', $allCategories->handle());
        } catch (Exception $exception) {
            return JsonResponse::handle($exception->getMessage(), 500);
        }
    }

    public function create(array $data): JsonResponse|null
    {
        try {
            $useCase = new CreateCategoryUseCase();
            return JsonResponse::handle('The category was created', $useCase->handle($data));
        } catch (\TypeError $exception) {
            return JsonResponse::handle('The category was not created', [], $exception->getMessage(), 400);
        } catch (PDOException $exception) {
            return JsonResponse::handle('The category was not created', [], $exception->getMessage(), 400);
        } catch (Exception $exception) {
            return JsonResponse::handle('The category was not created', [], $exception->getMessage(), 500);
        }
    }

    public function update($data): JsonResponse|null
    {
        try {
            $useCase = new UpdateCategoryUseCase();
            return JsonResponse::handle('The category was updated',$useCase->handle($data));
        } catch (\TypeError $exception) {
            return JsonResponse::handle('The category was not updated', [], $exception->getMessage(), 400);
        } catch (PDOException $exception) {
            return JsonResponse::handle('The category was not updated', [], $exception->getMessage(), 400);
        } catch (Exception $exception) {
            return JsonResponse::handle($exception->getMessage(), 500);
        }
    }

    public function delete(array $data): JsonResponse|null
    {
        try {
            $useCase = new DeleteCategoryUseCase();
            $useCase->handle($data);
            return JsonResponse::handle('The category was deleted', [],'', 202);
        } catch (PDOException $exception) {
            return JsonResponse::handle('The category was not deleted', [], $exception->getMessage(), 400);
        } catch (Exception $exception) {
            return JsonResponse::handle('The category was not deleted', [], $exception->getMessage(), 500);
        }
    }
}