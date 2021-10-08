$(document).ready(function () {
	$('#seatbook-officeid, #seatbook-booking_date, input[name="SeatBook[reservationDayTimeSlot]"]').on('change', function () {
		collectOfficeSeats();
	});
});

var collectOfficeSeats = function() {
	let officeId = ($('#seatbook-officeid').find(':selected').val() || '0').trim();
	let bookingDate = ($('#seatbook-booking_date').val() || '').trim();
	let timeSlotId = ($('input[name="SeatBook[reservationDayTimeSlot]"]:checked').val() || '0').trim();
	// Not all data collected.
	if (officeId === '' || officeId === '0'
		|| bookingDate === ''
		|| timeSlotId === '' || timeSlotId === '0') {
		return;
	}
	
	$.ajax({
		type: "GET",
		url: officeSeatsUrl,
		data: {
			officeId: officeId,
			bookingDate: bookingDate,
			timeSlotId: timeSlotId
		},
		success: function (result) {
			console.log(result);
		},
		error: function (exception) {
			alert(exception);
		}
	});
};