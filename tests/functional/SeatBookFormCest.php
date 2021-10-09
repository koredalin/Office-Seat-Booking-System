<?php

use app\services\DateTimeManager;

class SeatBookFormCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['seatbook/create']);
    }

    public function openContactPage(\FunctionalTester $I)
    {
        $I->see('Create Seat Book', 'h1');
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->submitForm('form', [
            'SeatBook[officeId]' => null,
        ]);
        $I->expectTo('see validations errors');
        $I->see('Create Seat Book', 'h1');
        $I->see('Employee ID cannot be blank.');
        $I->see('Seat Book Time Slot ID cannot be blank.');
    }

    public function submitFormWithIncorrectEmail(\FunctionalTester $I)
    {
        $dateTime = DateTimeManager::now();
        $dateTime->modify('+1 day');
        $dateTimeStr = $dateTime->format('Y-m-d');
        
        $I->submitForm('form', [
            'SeatBook[employee_id]' => 1,
            'SeatBook[officeId]' => 1,
            'SeatBook[booking_date]' => $dateTimeStr,
            'SeatBook[seat_id]' => 'fake_id',
            'SeatBook[seat_book_time_slot_id]' => 2,
        ]);
        $I->expectTo('see that email address is wrong');
        $I->dontSee('Booking Date cannot be blank.', '.help-block');
        $I->see('Seat ID must be an integer.', '.help-block');
        $I->dontSee('Office Id cannot be blank.');
    }
}
