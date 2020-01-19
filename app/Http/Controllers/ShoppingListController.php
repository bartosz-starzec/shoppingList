<?php

namespace App\Http\Controllers;

use App\Jobs\Jobs;
use App\Jobs\ProcessAddToShoppingList;
use App\Repositories\ShoppingListRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Routing\Controller;
use Psr\SimpleCache\InvalidArgumentException;

class ShoppingListController extends Controller
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
