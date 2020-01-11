<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\ProductCollection;
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
     * @return ProductCollection
     */
    public function index(): ProductCollection
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
