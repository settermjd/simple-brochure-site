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
        $I->canSeeElement('//input', [
            'name' => 'email',
            'type' => 'email',
            'class' => 'form-control',
        ]);
        $I->canSeeElement('//input', [
            'name' => 'name',
            'type' => 'text',
            'class' => 'form-control',
        ]);
        $I->canSeeElement('//textarea', [
            'name' => 'message',
            'class' => 'form-control',
        ]);
        $I->canSeeElement('//input', [
            'name' => 'submit',
            'type' => 'submit',
            'class' => 'btn btn-default btn-block',
        ]);
    }
}
