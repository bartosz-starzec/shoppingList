<?php

namespace App\Repositories;

use App\Exceptions\NotUniqueException;
use App\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductRepository implements ProductRepositoryInterface
{

    /**
     * @var Product
     */
    private $model;

    /**
     * ProductRepository constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        $this->model =$model;
    }

    /**
     * @return ResourceCollection
     */
    public function all(): ResourceCollection
    {
        return new ResourceCollection(Product::all());
    }

    /**
     *
     * @param string $name
     * @return JsonResponse
     * @throws NotUniqueException
     */
    public function save(string $name): JsonResponse
    {
        $product = new Product([
            'name' => $name
        ]);

        try {
            $product->save();
        } catch (\PDOException $exception) {
            if ($exception->getCode() === '23000') {
                throw new NotUniqueException('Product with that name already exists!', $exception->getCode());
            }
        }

        return response()->json('success');
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $product = $this->model->findOrFail($id);
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

    /**
     * @param int $id
     * @param string $name
     * @return JsonResponse
     */
    public function update(int $id, string $name): JsonResponse
    {
        $product = $this->model->findOrFail($id);
        $product->name = $name;

        $product->save();

        return response()->json('success');
    }
}
