<?php

namespace App\Repositories;

use App\Product;
use App\ShoppingList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Redis;

class ShoppingListRepository implements ShoppingListRepositoryInterface
{

    /**
     * @var ShoppingList
     */
    private $model;

    /**
     * @var Product
     */
    private $productModel;

    /**
     * ShoppingListRepository constructor.
     * @param ShoppingList $model
     * @param Product $productModel
     */
    public function __construct(ShoppingList $model, Product $productModel)
    {
        $this->model = $model;
        $this->productModel = $productModel;
    }

    /**
     * @return JsonResponse
     */
    public function save(): JsonResponse
    {
        $shoppingList = new ShoppingList([
            'name' => 'Shopping List '
        ]);

        $shoppingList->save();

        return response()->json('success');
    }

    /**
     * @return ResourceCollection
     */
    public function all(): ResourceCollection
    {
        return new ResourceCollection(ShoppingList::all());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $shoppingList = $this->model->findOrFail($id);
        $shoppingList->products()->detach();
        $shoppingList->delete();

        return response()->json('success');
    }

    /**
     * @param int $shoppingListId
     * @param int $productId
     */
    public function addProduct(int $shoppingListId, int $productId): void
    {
        $shoppingList = $this->model->findOrFail($shoppingListId);
        $product = $this->productModel->findOrFail($productId);

        $shoppingList->products()->syncWithoutDetaching($product);
    }

    /**
     * @param int $shoppingListId
     * @param int $productId
     * @return bool
     */
    public function removeProduct(int $shoppingListId, int $productId): bool
    {
        $shoppingList = $this->model->findOrFail($shoppingListId);

        $shoppingList->products()->detach([$productId]);

        return true;
    }
}
