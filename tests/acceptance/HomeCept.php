<?php 
$I = new AcceptanceTester($scenario);
$I->am('guest user');
$I->wantTo('visit home page');
$I->lookForwardTo('check that everything is as it should be');
$I->amOnPage('/');
$I->canSeeResponseCodeIs(200);
$I->canSee('Welcome to the Simple Brochure Site');
$I->canSee('This is a wonderfully uninteresting application, designed to support the Codeception course for PluralSight.');
