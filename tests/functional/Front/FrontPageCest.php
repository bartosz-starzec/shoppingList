<?php


namespace Tests\acceptance\Front;


use AcceptanceTester;

class FrontPageCest
{

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
    }
    public function testHeader(AcceptanceTester $I)
    {
        $I->amGoingTo('see front page of application');
        $I->see('Shopping List');
    }

    public function testProducts(AcceptanceTester $I)
    {
        $I->amGoingTo('see products section');
        $I->see('Products');
    }

    public function testAddProductButton(AcceptanceTester $I)
    {
        $I->amGoingTo('see add new product button');
        $I->see('Add new product');

        $I->click('Add new product');

        $I->amGoingTo('see new product form');
        $I->waitForElement('#product-name', 5);
        $I->see('Add product');
    }

    public function testAddingNewProduct(AcceptanceTester $I)
    {
        $I->amGoingTo('add new product to products list');
        $I->click('Add new product');

        $I->amGoingTo('input product name');
        $I->waitForElement('#product-name', 5);
        $I->fillField(['name' => 'product-name'], 'TestProduct');
        $I->click('Add product');
        $I->waitForElement(['name' => 'TestProduct'], 5);
    }

    public function testDeletingProduct(AcceptanceTester $I)
    {
        $I->amGoingTo('delete product from products list');

        $I->amGoingTo('check product to delete');
        $I->click('label[for="product-2"]');
        $I->click('Delete products');

        $I->waitForElementNotVisible(['name' => 'TestProduct'], 5);
    }

}
