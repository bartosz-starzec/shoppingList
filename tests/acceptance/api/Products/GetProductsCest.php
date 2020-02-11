<?php

class GetProductsCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function tryToGetProductsList(AcceptanceTester $I): void
    {
        $I->sendGET('products');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContains('data');
    }
}
