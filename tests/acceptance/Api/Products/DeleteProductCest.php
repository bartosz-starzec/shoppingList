<?php

class DeleteProductCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveInDatabase('maindb.products', [
            'id' => 500,
            'name' => 'Test'
        ]);

        $I->haveInDatabase('maindb.products', [
            'id' => 501,
            'name' => 'Test1'
        ]);
    }

    /**
     * @param AcceptanceTester $I
     */
    public function tryToDeleteProducts(AcceptanceTester $I): void
    {
        $productsIds = [500, 501];
        $I->sendDELETE('products/delete/'. implode(',', $productsIds));
        $I->seeResponseCodeIs(200);

        foreach ($productsIds as $productId) {
            $product = $I->grabRecord('maindb.products', ['id' => $productId]);
            $I->assertNotNull($product['deleted_at']);
        }
    }

    public function tryToDeleteNonExistingProduct(AcceptanceTester $I): void
    {
        $I->sendDELETE('products/delete/520');
        $I->seeResponseCodeIs(400);
    }
}
