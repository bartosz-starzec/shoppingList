<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\ProductStore;
use App\Http\Requests\Products\ProductUpdate;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Routing\Controller;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
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
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        return $this->productRepository->all();
    }


    /**
     * @param ProductStore $request
     * @return JsonResponse
     */
    public function store(ProductStore $request): JsonResponse
    {
        return $this->productRepository->save($request->get('name'));
    }

    /**
     * @param ProductUpdate $request
     * @return JsonResponse
     */
    public function update(ProductUpdate $request): JsonResponse
    {
        return $this->productRepository->update($request->get('id'), $request->get('name'));
    }

    /**
     * @param string $ids
     * @return void
     */
    public function deleteMany(string $ids): void
    {
        $ids = explode(',', $ids);
        $this->productRepository->deleteMany($ids);
    }
}
