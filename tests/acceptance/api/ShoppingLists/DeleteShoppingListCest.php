<?php

namespace Tests\acceptance\api\ShoppingLists;

use AcceptanceTester;

class DeleteShoppingListCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function tryToDeleteShoppingList(AcceptanceTester $I): void
    {
        $I->haveInDatabase('maindb.shopping_lists', [
            'id' => 120,
            'name' => 'TestShoppingList'
        ]);
        $I->sendDELETE('shopping-lists/delete/120');
        $I->seeResponseCodeIs(200);

        $I->dontSeeInDatabase('maindb.shopping_lists', [
            'name' => 'TestShoppingList'
        ]);
    }
}
