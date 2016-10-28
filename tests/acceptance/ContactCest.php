<?php

use Faker\Factory;

class ContactCest
{
    /**
     * @var Faker\Generator
     */
    private $faker;

    public function _before(AcceptanceTester $I)
    {
        $this->faker = Factory::create();
    }

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

        // Validate that the form can be correctly submitted
        $I->submitForm('#Contact', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'message' => $this->faker->text
        ]);
        $I->seeCurrentUrlEquals('/contact');
        $I->canSeeResponseCodeIs(200);
    }
}
