<?php

use app\services\DateTimeManager;

class SeatBookFormCest 
{
    /**
     * First seat id related in Sun office. Office seat id 1.
     */
    private const SEAT_ID = 9;
    
    /**
     * Time slot from 09:0":00 to 09:59:59.
     */
    private const SEAT_BOOK_TIME_SLOT_ID = 2;
    
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['seatbook/create']);
    }

    public function openSeatBookPage(\FunctionalTester $I)
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

    public function submitFormWithIncorrectSeatId(\FunctionalTester $I)
    {
        
        $I->submitForm('form', [
            'SeatBook[employee_id]' => 1,
            'SeatBook[officeId]' => 1,
            'SeatBook[booking_date]' => $this->tomorrow(),
            'SeatBook[seat_id]' => 'fake_id',
            'SeatBook[seat_book_time_slot_id]' => self::SEAT_BOOK_TIME_SLOT_ID,
        ]);
        $I->expectTo('see that email address is wrong');
        $I->dontSee('Booking Date cannot be blank.', '.help-block');
        $I->see('Seat ID must be an integer.', '.help-block');
        $I->dontSee('Office Id cannot be blank.');
    }

    public function submitAlreadySubmittedForm(\FunctionalTester $I)
    {
        $I->submitForm('form', [
            'SeatBook[employee_id]' => 1,
            'SeatBook[officeId]' => 1,
            'SeatBook[booking_date]' => $this->tomorrow(),
            'SeatBook[seat_id]' => self::SEAT_ID,
            'SeatBook[seat_book_time_slot_id]' => self::SEAT_BOOK_TIME_SLOT_ID,
        ]);
        
        $I->amOnPage(['seatbook/create']);
        
        $I->submitForm('form', [
            'SeatBook[employee_id]' => 1,
            'SeatBook[officeId]' => 1,
            'SeatBook[booking_date]' => $this->tomorrow(),
            'SeatBook[seat_id]' => self::SEAT_ID,
            'SeatBook[seat_book_time_slot_id]' => self::SEAT_BOOK_TIME_SLOT_ID,
        ]);
        
        $I->expectTo('see that email address is wrong');
        $I->see('The combination "'.$this->tomorrow().'"-"'.self::SEAT_ID.'"-"'.self::SEAT_BOOK_TIME_SLOT_ID.'" of Booking Date, Office Seat ID and Seat Book Time Slot ID has already been taken.');
    }
    
    private function tomorrow(): string
    {
        $dateTime = DateTimeManager::now();
        $dateTime->modify('+1 day');
        $dateTimeStr = $dateTime->format('Y-m-d');
        
        return $dateTimeStr;
    }
}
