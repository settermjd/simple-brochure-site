<?php

/**
 * Class DisclaimerCest
 * @group BusinessPages
 */
class DisclaimerCest
{
    public function canViewTheDisclaimerPage(
        AcceptanceTester $I,
        \Page\DisclaimerPage $disclaimerPage
    ) {
        $I->am('guest user');
        $I->wantTo('visit the disclaimer page');
        $I->lookForwardTo('check that everything is as it should be');
        $I->amOnPage($disclaimerPage::$URL);
        $I->canSeeResponseCodeIs(200);
        $I->canSee(ucfirst($disclaimerPage::$TITLE), '//h1');
        $I->canSeeInTitle(ucfirst($disclaimerPage::$TITLE));
    }
}
