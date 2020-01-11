<?php
namespace App\Repositories;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface ShoppingListProductsRepositoryInterface
{
    /**
     * @param int $id
     * @return ResourceCollection
     */
    public function getById(int $id): ResourceCollection;

    /**
     * @param int $shoppingListId
     * @param array $productsIds
     * @return JsonResponse
     */
    public function saveMany(int $shoppingListId, array $productsIds): JsonResponse;

    /**
     * @param int $shoppingListId
     * @param array $productsIds
     * @return JsonResponse
     */
    public function deleteMany(int $shoppingListId, array $productsIds): JsonResponse;

}
