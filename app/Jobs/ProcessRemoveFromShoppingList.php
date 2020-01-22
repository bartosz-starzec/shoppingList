<?php
namespace App\Jobs;

use App\Repositories\ShoppingListRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessRemoveFromShoppingList
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var ShoppingListRepositoryInterface
     */
    private $shoppingListRepository;

    /**
     * @var int
     */
    private $shoppingListId;

    /**
     * @var array
     */
    private $productsIds;
    /**
     * @var string
     */
    private $jobKey;

    /**
     * @var CacheRepository
     */
    private $cacheRepository;

    private $removedProductsCounter = 0;

    /***
     * @param int $shoppingListId
     * @param array $productsIds
     * @param string $jobKey
     */
    public function __construct(int $shoppingListId, array $productsIds, string $jobKey)
    {
        $this->shoppingListId = $shoppingListId;
        $this->productsIds = $productsIds;

        $this->jobKey = $jobKey;
    }

    /**
     * Execute the job.
     *
     * @param ShoppingListRepositoryInterface $shoppingListRepository
     * @param CacheRepository $cacheRepository
     * @return bool
     */
    public function handle(ShoppingListRepositoryInterface $shoppingListRepository, CacheRepository $cacheRepository): bool
    {
        $this->shoppingListRepository = $shoppingListRepository;
        $this->cacheRepository = $cacheRepository;

        return $this->removeProducts();
    }

    /**
     * @return bool
     */
    private function removeProducts(): bool
    {
        foreach ($this->productsIds as $productId) {
            if ($this->shoppingListRepository->removeProduct($this->shoppingListId, $productId)) {
                $this->removedProductsCounter++;
            }
        }

        $cacheData = $this->prepareCacheData();

        return $this->cacheJobResult($cacheData, $this->jobKey);
    }

    /**
     * @param array $data
     * @param string $jobKey
     * @return bool
     */
    private function cacheJobResult(array $data, string $jobKey): bool
    {
        return $this->cacheRepository->add($jobKey, $data, 500);
    }

    /**
     * @return array
     */
    private function prepareCacheData(): array
    {
        return [
            'shoppingListId' => $this->shoppingListId,
            'productsAmount' => $this->removedProductsCounter
        ];
    }
}
