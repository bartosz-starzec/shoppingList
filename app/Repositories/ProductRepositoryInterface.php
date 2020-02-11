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
     * @return string
     */
    public function save(string $name): string;

    /**
     * @param int $id
     * @param string $name
     * @return string
     */
    public function update(int $id, string $name): string;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param array $ids
     * @return string
     */
    public function deleteMany(array $ids): string;
}
