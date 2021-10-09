<p align="center">
    <h1 align="center">Office-Seat Booking System</h1>
    <br>
</p>

Office-Seat Booking System is an web app for booking `n` seats in `m` offices.

The offices have names and seats only ids in the office.


Used Technologies
------------

- PHP7.4
- MySQL
- jQuery
- jQuery UI
- CodeSeption testing framework


INSTALLATION and CONFIGURATION
------------

### Install via Composer

1. Clone the the repo.
2. Next - execute command `composer install` in main folder.
3. Make a database with the [SQL dump file](https://github.com/koredalin/Office-Seat-Booking-System/blob/master/common/db_backups/office_booking_8X2021.sql).
4. Configure the database from `/config/db.php`.
5. Start the project from \{domain\}/\{project_folder\}/web/index.php


DOCUMENTATION
-------------

- [Roadmap](https://github.com/koredalin/Office-Seat-Booking-System/blob/master/common/docs/roadmap.md)
- [Yii 2 Basic Project Template](https://github.com/koredalin/Office-Seat-Booking-System/blob/master/common/docs/Yii2_README.md)


TESTING
-------

You can run the tests with `php vendor/bin/codecept run unit,functional` command into the project folder.

Provided tests for:

- `employees` table unit tests.
- `seats_book` table functional tests.