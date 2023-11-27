<?php 

namespace App\Tests\acceptance;

use App\Tests\AcceptanceTester;

class RegistrationCest
{
    public function frontpageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Become An Admin');
    }

    public function registrationpageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/register');
        $I->seeElement('#registration_form_fullname');
        $I->seeElement('#registration_form_username');
        $I->seeElement('#registration_form_email');
        $I->seeElement('#registration_form_plainPassword_first');
        $I->seeElement('#registration_form_plainPassword_second');
        $I->seeElement('#registration_form_agreeTerms');
        $I->seeElement('button[type="submit"]');
    }

    public function registrationFormWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/register');
        $I->fillField('registration_form[fullname]', 'TestfullnameAcceptance');
        $I->fillField('registration_form[username]', 'TestusernameAcceptance');
        $I->fillField('registration_form[email]', 'testusernameAcceptance@test.com');
        $I->fillField('registration_form[plainPassword][first]', '123456');
        $I->fillField('registration_form[plainPassword][second]', '123456');
        $I->checkOption('Agree terms');
        $I->click('Register');
        $I->see('Login');
    }
}