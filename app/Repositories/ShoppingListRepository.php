<?php

namespace App\Repositories;

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

        return response()->json('success');
    }

}
