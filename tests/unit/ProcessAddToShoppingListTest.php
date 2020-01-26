<?php

namespace Tests\Unit;

use App\Jobs\ProcessAddToShoppingList;
use App\Repositories\ShoppingListRepository;
use Illuminate\Cache\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery;
use PHPUnit\Framework\TestCase;

class ProcessAddToShoppingListTest extends TestCase
{
    /**
     * @var Repository|Mockery\LegacyMockInterface|Mockery\MockInterface
     */
    private $cacheRepository;

    /**
     * @var ShoppingListRepository|Mockery\LegacyMockInterface|Mockery\MockInterface
     */
    private $shoppingListRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->cacheRepository = Mockery::mock(Repository::class);
        $this->cacheRepository->shouldReceive('add')->andReturn(true);
        $this->shoppingListRepository = Mockery::mock(ShoppingListRepository::class);
    }

    public function testHandleWithProducts(): void
    {
        $shoppingListId = 1;
        $productsIds = [1,2];
        $jobKey = 'test';

        $this->shoppingListRepository->shouldReceive('addProduct')->andThrow(ModelNotFoundException::class);
        $processAddToShoppingList = new ProcessAddToShoppingList($shoppingListId, $productsIds,$jobKey);
        $processAddToShoppingList->handle($this->shoppingListRepository, $this->cacheRepository);
    }
}
