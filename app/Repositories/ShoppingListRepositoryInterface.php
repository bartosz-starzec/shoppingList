<?php
namespace App\Repositories;

use App\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface ShoppingListRepositoryInterface
{
    /**
     * @return JsonResponse
     */
    public function save(): JsonResponse;

    /**
     * @return ResourceCollection
     */
    public function all(): ResourceCollection;

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse;

    /**
     * @param int $shoppingListId
     * @param int $productId
     * @return void
     */
    public function addProduct(int $shoppingListId, int $productId): void;

    /**
     * @param int $shoppingListId
     * @param int $productId
     * @return bool
     */
    public function removeProduct(int $shoppingListId, int $productId): bool;

}
