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
     * @param Product $product
     * @return bool
     */
    public function addProduct(int $shoppingListId, Product $product): bool;

}
