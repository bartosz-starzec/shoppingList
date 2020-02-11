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
     * @return string
     * @throws NotUniqueException
     */
    public function save(string $name): string
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

        return $product->name . ' saved';
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
     * @return string
     */
    public function deleteMany(array $ids): string
    {
        $count = 0;
        foreach ($ids as $id) {
            $this->delete($id);
            $count++;
        }

        return 'Deleted ' . $count . ' products.';
    }

    /**
     * @param int $id
     * @param string $name
     * @return string
     */
    public function update(int $id, string $name): string
    {
        $product = $this->model->findOrFail($id);
        $product->name = $name;

        $product->save();

        return $product->name . ' updated';
    }
}
