<?php

namespace App\Tests\acceptance;

use App\Tests\AcceptanceTester;

class EnrollmentCest
{
    public function coursepageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->fillField('_username', 'TestusernameAcceptance');
        $I->fillField('_password', '123456');
        $I->click('button[type="submit"]');
        $I->see('Create profile');

        $I->amOnPage('/courses');
        $I->see('Courses');
        $I->see('Enroll');
        $I->click('Enroll');
        $I->seeElement('.home_content');
    }
}
