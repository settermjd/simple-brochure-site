<?php

/**
 * Class HomeCest
 * @group BusinessPages
 */
class HomeCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function testHomePage(AcceptanceTester $I)
    {
        $I->am('guest user');
        $I->wantTo('visit home page');
        $I->lookForwardTo('check that everything is as it should be');
        $I->amOnPage('/');
        $I->canSeeResponseCodeIs(200);
        $I->canSee('Welcome to the Simple Brochure Site');
        $I->canSee('This is a wonderfully uninteresting application, designed to support the Codeception course for PluralSight.');
    }
}
