<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        return $this->productRepository->save($request->get('name'));
    }

    public function update(Request $request)
    {
        return $this->productRepository->update($request->get('id'), $request->get('name'));
    }

    /**
     * @param string $ids
     * @return void
     */
    public function deleteMany(string $ids)
    {
        $ids = explode(',', $ids);
        $this->productRepository->deleteMany($ids);
    }
}
