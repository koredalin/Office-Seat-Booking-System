# Office-Seat Booking System - Roadmap

## Database

- [x] MySql database scheme implementation.
- [x] Adding data to nomenclature table `seat_book_time_slot`.
- [x] Some starting point database backup sql. Migrations could be added on later stage.
	[SQL dump](https://github.com/koredalin/Office-Seat-Booking-System/blob/master/common/db_backups/office_booking_8X2021.sql)
- [x] The database scheme as an image.
	[DB Scheme image](https://github.com/koredalin/Office-Seat-Booking-System/blob/master/common/db_backups/DB_Scheme_8X2021.png)

## Yii2 framework deployment

- [x] Yii2 basic application installation.
	[Yii framework web site](https://www.yiiframework.com/)

### CRUD

The default CRUD is made with [Yii2 Gii](https://www.yiiframework.com/doc/guide/2.0/en/start-gii) generator.

- [x] Employee model.
- [x] Office model.
- [x] Seat model.
- [x] SeatBook model.
- [x] SeatBookTimeSlot model. Nomenclature table. Only model and query classes added. Changing the table could broke the system.

### Adding default data for testing later development.

- [x] Adding some data to tables `employees`, `offices`, `seats`.

### Application core functionality implementation

- [x] Remaking `/seatbook/create` url-action to meet the task requirements.
	An office-seat booking is add with choosing an employee, an office, a booking date, a time slot from the day. The last thing that the user should choose is a seat in the office (Implemented with an ajax request to the backend.).

### User readable and filtered data into the view indexes

- [x] Seat view. Url: `/seat/index`.
- [x] SeatBook view. Url: `/seatbook/index`.

### Common

- [x] Adding git tags through the development.

### CodeSeption Testing

- [ ] An Unit test.
- [ ] An functional test.

### Good practices future upgrades

- [x] Database migrations.
- [x] Using db keys (A string unique representation of a db table row.) instead of the default db ids.
- [x] Eventually.. - Dependency injection for access to the Query files. Not supported by the default Gii generator. This would be a better option if the system migrates to Yii3. :-)