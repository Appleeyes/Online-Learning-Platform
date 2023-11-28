<?php

namespace App\Tests\acceptance;

use App\Tests\AcceptanceTester;

class LoginCest
{
    public function loginpageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->seeElement('#username');
        $I->seeElement('#password');
        $I->seeElement('button[type="submit"]');
    }

    public function loginFormFailedOnWrongCredentials(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->fillField('_username', 'TestusernameAcceptance1');
        $I->fillField('_password', '123456');
        $I->click('button[type="submit"]');
        $I->see('Invalid credentials.');
    }

    public function loginFormWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->fillField('_username', 'TestusernameAcceptance');
        $I->fillField('_password', '123456');
        $I->click('button[type="submit"]');
        $I->see('Create profile');
    }
}
