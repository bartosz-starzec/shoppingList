<?php

namespace App\Repositories;

use App\Product;
use App\Http\Resources\ProductCollection;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @return ProductCollection
     */
    public function all(): ProductCollection
    {
        return new ProductCollection(Product::all());
    }

    /**
     *
     * @param string $name
     * @return JsonResponse
     */
    public function save(string $name): JsonResponse
    {
        $product = new Product([
            'name' => $name
        ]);

        $product->save();

        return response()->json('success');
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $product = Product::find($id);
        $product->delete();

        return true;
    }

    /**
     * @param array $ids
     * @return bool
     */
    public function deleteMany(array $ids): bool
    {
        foreach ($ids as $id) {
            $this->delete($id);
        }

        return true;
    }
}
