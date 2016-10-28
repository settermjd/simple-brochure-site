<?php
namespace Page;

class ContactPage
{
    // include url of current page
    public static $URL = '/contact';
    public static $TITLE = 'contact';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }

    public function validateContactPage(\AcceptanceTester $I, \Page\ContactPage $contactPage)
    {
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
