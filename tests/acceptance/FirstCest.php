<?php

class FirstCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->seeInDatabase('maindb.products', [
            'id' => 1
        ]);

        $I->amOnPage('/');
        $I->see('Products');
    }
}
