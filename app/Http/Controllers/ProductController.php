<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\ProductStore;
use App\Http\Requests\Products\ProductUpdate;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ProductController extends ApiController
{

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->respond($this->productRepository->all());
    }


    /**
     * @param ProductStore $request
     * @return JsonResponse
     */
    public function store(ProductStore $request): JsonResponse
    {
        return $this->respond($this->productRepository->save($request->get('name')));
    }

    /**
     * @param ProductUpdate $request
     * @return JsonResponse
     */
    public function update(ProductUpdate $request): JsonResponse
    {
        return $this->respond(
            $this->productRepository->update($request->get('id'), $request->get('name'))
        );
    }

    /**
     * @param string $ids
     * @return JsonResponse
     */
    public function deleteMany(string $ids): JsonResponse
    {
        $ids = explode(',', $ids);
        return $this->respond(
            $this->productRepository->deleteMany($ids)
        );
    }
}
