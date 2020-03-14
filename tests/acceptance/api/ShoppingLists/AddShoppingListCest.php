<?php

namespace Tests\acceptance\api\ShoppingLists;

use AcceptanceTester;

class AddShoppingListCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function tryToStoreShoppingList(AcceptanceTester $I): void
    {
        $I->sendPOST('shopping-lists/create', ['name' => 'TestShoppingList']);
        $I->seeResponseCodeIs(200);

        $I->seeInDatabase('maindb.shopping_lists', [
            'name' => 'TestShoppingList'
        ]);
    }

    /**
     * @param AcceptanceTester $I
     */
    public function tryToStoreWithWrongParam(AcceptanceTester $I): void
    {
        $I->sendPOST('shopping-lists/create', ['id' => 'TestShoppingList']);
        $I->seeResponseCodeIs(400);

        $I->dontSeeInDatabase('maindb.shopping_lists', [
            'name' => 'TestShoppingList'
        ]);
    }

    /**
     * @param AcceptanceTester $I
     */
    public function tryToStoreWithoutParam(AcceptanceTester $I): void
    {
        $I->sendPOST('shopping-lists/create');
        $I->seeResponseCodeIs(400);

        $I->dontSeeInDatabase('maindb.shopping_lists', [
            'name' => 'TestShoppingList'
        ]);
    }

    /**
     * @param AcceptanceTester $I
     */
    public function tryToStoreDuplicate(AcceptanceTester $I): void
    {
        $I->haveInDatabase('maindb.shopping_lists', [
            'name' => 'TestShoppingList'
        ]);
        $I->sendPOST('shopping-lists/create', ['name' => 'TestShoppingList']);
        $I->seeResponseCodeIs(400);

        $recordsCount = $I->grabNumRecords('maindb.shopping_lists', [
            'name' => 'TestShoppingList'
        ]);

        $I->assertEquals(1, $recordsCount);
    }

    public function _after(AcceptanceTester $I): void
    {
        $I->deleteFromDatabase('maindb.shopping_lists', [
           'name' => 'TestShoppingList'
        ]);
    }
}
