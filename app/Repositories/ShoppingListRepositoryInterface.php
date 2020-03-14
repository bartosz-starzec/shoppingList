<?php
namespace App\Repositories;

use App\Http\Requests\Products\ShoppingListStore;
use App\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface ShoppingListRepositoryInterface
{
    /**
     * @param string $name
     * @return string
     */
    public function save(string $name): string;

    /**
     * @return ResourceCollection
     */
    public function all(): ResourceCollection;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

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
