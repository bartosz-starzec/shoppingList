<?php

namespace App\Repositories;

use App\Exceptions\NotUniqueException;
use App\Http\Requests\Products\ShoppingListStore;
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
     * @param string $name
     * @return string
     * @throws NotUniqueException
     */
    public function save(string $name): string
    {
        $shoppingList = new ShoppingList([
            'name' => $name
        ]);

        try {
            $shoppingList->save();
        } catch (\PDOException $exception) {
            if ($exception->getCode() === '23000') {
                throw new NotUniqueException('Shopping List with that name already exists!', $exception->getCode());
            }
        }

        return $shoppingList->name . ' saved';
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
     * @return bool
     */
    public function delete(int $id): bool
    {
        $shoppingList = $this->model->findOrFail($id);
        $shoppingList->products()->detach();
        $shoppingList->delete();

        return true;
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
