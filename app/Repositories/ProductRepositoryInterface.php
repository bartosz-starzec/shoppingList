<?php

namespace App\Repositories;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface ProductRepositoryInterface
{
    /**
     * @return ResourceCollection
     */
    public function all(): ResourceCollection;

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
