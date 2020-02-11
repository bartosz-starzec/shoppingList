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

    }

//    public function tryToDeleteShoppingList(AcceptanceTester $I): void
//    {
//        $I->sendPOST('shopping-lists/create');
//        $I->seeResponseCodeIs(200);
//        $recordsCount = $I->grabNumRecords('maindb.shopping_lists');
//
//        $createdList = $recordsCount + 1;
//        $I->sendDELETE('shopping-lists/delete/' . $createdList);
//        $I->seeResponseCodeIs(200);
//
//        $I->seeInDatabase('maindb.shopping_lists', [
//            'id' => $createdList,
//            'deleted_at' => now()
//        ]);
//        $I->deleteFromDatabase('maindb.shopping_lists', ['id' => $createdList + 1]);
//    }
}
