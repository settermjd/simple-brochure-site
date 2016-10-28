<?php


class ContactCest
{
    public function canViewAndSubmitTheContactPage(
        AcceptanceTester $I,
        \Page\ContactPage $contactPage
    ) {
        $I->am('guest user');
        $I->wantTo('visit the contact page');
        $I->lookForwardTo('check that everything is as it should be and that a value can be submitted');
        $I->amOnPage($contactPage::$URL);
        $I->canSeeResponseCodeIs(200);
        $contactPage->validateContactPage($I, $contactPage);
    }
}
