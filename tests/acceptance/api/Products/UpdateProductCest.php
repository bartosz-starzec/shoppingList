<?php

class UpdateProductCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function _before(AcceptanceTester $I): void
    {
        $I->haveInDatabase('maindb.products', [
            'id' => 500,
            'name' => 'Test'
        ]);
    }

    /**
     * @param AcceptanceTester $I
     */
    public function tryToUpdateProduct(AcceptanceTester $I): void
    {
        $I->sendPOST('products/update', [
            'id' => 500,
            'name' => 'Test1'
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeInDatabase('maindb.products', [
            'id' => 500,
            'name' => 'Test1'
        ]);
    }

    public function tryToUpdateNotExistingProduct(AcceptanceTester $I): void
    {
        $I->sendPOST('products/update', [
            'id' => 520,
            'name' => 'Test1'
        ]);
        $I->seeResponseCodeIs(400);
        $I->dontSeeInDatabase('maindb.products', [
            'id' => 520,
            'name' => 'Test1'
        ]);
    }

    /**
     * @param AcceptanceTester $I
     */
    public function _after(AcceptanceTester $I): void
    {
        $I->deleteFromDatabase('maindb.products', [
            'name' => 'Test1'
        ]);
    }
}
