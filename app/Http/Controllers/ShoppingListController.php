<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoppingLists\ShoppingListStore;
use App\Jobs\Jobs;
use App\Jobs\ProcessAddToShoppingList;
use App\Jobs\ProcessRemoveFromShoppingList;
use App\Repositories\ShoppingListRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Psr\SimpleCache\InvalidArgumentException;

class ShoppingListController extends ApiController
{
    /**
     * @var ShoppingListRepositoryInterface
     */
    private $shoppingListRepository;

    /**
     * @var Jobs
     */
    private $jobs;

    /**
     * ShoppingListController constructor.
     * @param ShoppingListRepositoryInterface $shoppingListRepository
     * @param Jobs $jobs
     */
    public function __construct(ShoppingListRepositoryInterface $shoppingListRepository, Jobs $jobs)
    {
        $this->shoppingListRepository = $shoppingListRepository;
        $this->jobs = $jobs;
    }

    /**
     * @param ShoppingListStore $request
     * @return JsonResponse
     */
    public function store(ShoppingListStore $request): JsonResponse
    {
        return $this->respond($this->shoppingListRepository->save($request->get('name')));
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
        return $this->respond($this->shoppingListRepository->delete($request->route('id')));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storeProducts(Request $request): JsonResponse
    {
        $shoppingListId = $request->route('id');
        $productsIds = $request->get('productsIds');
        $jobKey = $request->get('jobKey');

        ProcessAddToShoppingList::dispatch($shoppingListId, $productsIds, $jobKey);

        $returnMessage = 'Adding ' . count($productsIds) . ' products to shopping list ' . $shoppingListId . '...';

        return response()->json($returnMessage);
    }

    public function removeProducts(Request $request)
    {
        $shoppingListId = $request->route('id');
        $productsIds = $request->get('productsIds');
        $jobKey = $request->get('jobKey');

        ProcessRemoveFromShoppingList::dispatch($shoppingListId, $productsIds, $jobKey);

        $returnMessage = 'Removing ' . count($productsIds) . ' products from shopping list ' . $shoppingListId . '...';

        return response()->json($returnMessage);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function getJobStatus(Request $request)
    {
        return response()->json($this->jobs->getJobStatus($request->get('jobKey')));
    }
}
