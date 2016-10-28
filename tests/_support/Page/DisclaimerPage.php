<?php
namespace Page;

class DisclaimerPage
{
    // include url of current page
    public static $URL = '/disclaimer';
    public static $TITLE = 'disclaimer';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     * @param string $param
     * @return string
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }

}
