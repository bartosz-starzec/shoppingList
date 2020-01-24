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
        $shoppingList = ShoppingList::find($id);
        $shoppingList->products()->detach();
        $shoppingList->delete();

        return response()->json('success');
    }

    /**
     * @param int $shoppingListId
     * @param Product $product
     * @return bool
     */
    public function addProduct(int $shoppingListId, Product $product): bool
    {
        $shoppingList = ShoppingList::find($shoppingListId);

        $shoppingList->products()->syncWithoutDetaching($product);

        return true;
    }

    /**
     * @param int $shoppingListId
     * @param int $productId
     * @return bool
     */
    public function removeProduct(int $shoppingListId, int $productId): bool
    {
        $shoppingList = ShoppingList::find($shoppingListId);

        $shoppingList->products()->detach([$productId]);

        return true;
    }
}
