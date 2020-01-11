<?php


namespace App\Repositories;


use App\ShoppingList;
use App\ShoppingListProducts;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ShoppingListProductsRepository implements ShoppingListProductsRepositoryInterface
{
    /**
     * @param int $id
     * @return ResourceCollection
     */
    public function getById(int $id): ResourceCollection
    {
        $shoppingList = ShoppingListProducts::where('shopping_list_id', $id)->get();
        return new ResourceCollection($shoppingList);
    }

    /**
     * @param int $shoppingListId
     * @param array $productsIds
     * @return JsonResponse
     */
    public function saveMany(int $shoppingListId, array $productsIds): JsonResponse
    {
        foreach ($productsIds as $productId) {
            $shoppingListProducts = new ShoppingListProducts([
                'shopping_list_id' => $shoppingListId,
                'product_id' => $productId,
                'amount' => 1
            ]);

            $shoppingListProducts->save();
        }

        return response()->json('success');
    }

    /**
     * @param int $shoppingListId
     * @param array $productsIds
     * @return JsonResponse
     */
    public function deleteMany(int $shoppingListId, array $productsIds): JsonResponse
    {
        // TODO: Implement deleteMany() method.
    }

}
