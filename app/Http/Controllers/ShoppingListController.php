<?php

namespace App\Http\Controllers;

use App\Repositories\ShoppingListRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Routing\Controller;

class ShoppingListController extends Controller
{
    /**
     * @var ShoppingListRepositoryInterface
     */
    private $shoppingListRepository;

    /**
     * ShoppingListController constructor.
     * @param ShoppingListRepositoryInterface $shoppingListRepository
     */
    public function __construct(ShoppingListRepositoryInterface $shoppingListRepository)
    {
        $this->shoppingListRepository = $shoppingListRepository;
    }

    /**
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        return $this->shoppingListRepository->save();
    }

    public function index(): ResourceCollection
    {
        return $this->shoppingListRepository->all();
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        return $this->shoppingListRepository->delete($request->route('id'));
    }

    public function storeProducts(Request $request)
    {
        $shoppingListId = $request->route('id');
        $productsIds = $request->get('productsIds');
        $this->shoppingListRepository->addProducts($shoppingListId, $productsIds);
    }
}
