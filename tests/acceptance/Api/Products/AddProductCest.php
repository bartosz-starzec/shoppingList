<?php

class AddProductCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function tryToStoreNewProduct(AcceptanceTester $I): void
    {
        $I->sendPOST('products/create', [
            'name' => 'Test'
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeInDatabase('maindb.products', [
            'name' => 'Test'
        ]);
    }

    /**
     * @param AcceptanceTester $I
     */
    public function tryToStoreDuplicate(AcceptanceTester $I): void
    {
        $I->haveInDatabase('maindb.products', [
            'name' => 'Test'
        ]);

        $I->sendPOST('products/create', [
            'name' => 'Test'
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeNumRecords(1, 'maindb.products', ['name' => 'Test']);
    }

    /**
     * @param AcceptanceTester $I
     */
    public function tryToStoreWithInvalidRequest(AcceptanceTester $I): void
    {
        $I->sendPOST('products/create', [
            'test' => 'Test'
        ]);

        $I->seeResponseCodeIs(400);
        $I->dontSeeInDatabase('maindb.products', [
            'name' => 'Test'
        ]);
    }

    /**
     * @param AcceptanceTester $I
     */
    public function _after(AcceptanceTester $I): void
    {
        $I->deleteFromDatabase('maindb.products', [
            'name' => 'Test'
        ]);
    }
}
