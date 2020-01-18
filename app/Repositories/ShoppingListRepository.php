<?php

namespace App\Repositories;

use App\Product;
use App\ShoppingList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ShoppingListRepository implements ShoppingListRepositoryInterface
{
    /**
     * @return JsonResponse
     */
    public function save(): JsonResponse
    {
        $count = count(ShoppingList::all());
        $shoppingList = new ShoppingList([
            'name' => 'Shopping List ' . $count
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
        $shoppingList->delete();
        $shoppingList->products()->delete();

        return response()->json('success');
    }

    /**
     * @param int $shoppingListId
     * @param array $productsId
     * @return JsonResponse
     */
    public function addProducts(int $shoppingListId, array $productsId): JsonResponse
    {
        $shoppingList = ShoppingList::find($shoppingListId);
        $products = [];
        foreach ($productsId as $productId) {
            $products[] = Product::find($productId);
        }

        $shoppingList->products()->saveMany($products);

        return response()->json('success');
    }
}
