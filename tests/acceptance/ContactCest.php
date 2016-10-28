<?php


class ContactCest
{
    public function canViewTheContactPage(
        AcceptanceTester $I,
        \Page\ContactPage $contactPage
    ) {
        $I->am('guest user');
        $I->wantTo('visit the contact page');
        $I->lookForwardTo('check that everything is as it should be');
        $I->amOnPage($contactPage::$URL);
        $I->canSeeResponseCodeIs(200);
        $I->canSee(ucfirst($contactPage::$TITLE), '//h1');
        $I->canSeeInTitle(ucfirst($contactPage::$TITLE));
    }
}
