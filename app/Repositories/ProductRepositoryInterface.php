<?php

namespace App\Repositories;

use App\Http\Resources\ProductCollection;
use Illuminate\Http\JsonResponse;

interface ProductRepositoryInterface
{
    /**
     * @return ProductCollection
     */
    public function all(): ProductCollection;

    /**
     * @param string $name
     * @return JsonResponse
     */
    public function save(string $name): JsonResponse;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param array $ids
     * @return bool
     */
    public function deleteMany(array $ids): bool;
}
