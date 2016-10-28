<?php


class DisclaimerCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function canViewTheDisclaimerPage(AcceptanceTester $I, \Page\DisclaimerPage $disclaimerPage)
    {
        $I->am('guest user');
        $I->wantTo('visit the disclaimer page');
        $I->lookForwardTo('check that everything is as it should be');
        $I->amOnPage($disclaimerPage::$URL);
        $I->canSeeResponseCodeIs(200);
        $I->canSee(ucfirst($disclaimerPage::$TITLE), '//h1');
        $I->canSeeInTitle(ucfirst($disclaimerPage::$TITLE));
    }
}
