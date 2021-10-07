$(document).ready(function () {

	$('#seatbook-officeid, #seatbook-booking_date, input[name="SeatBook[reservationDayTimeSlot]"]').on('change', function () {
		collectOfficeSeats();
	});
//	$('#seatbook-booking_date').bind('change', function () {
//		collectOfficeSeats();
//	});
});

var collectOfficeSeats = function() {
	console.log('dfasadf');
	
	let officeId = $('#seatbook-officeid').find(':selected').val();
	let bookingDate = $('#seatbook-booking_date').val();
	let timeSlotId = $('input[name="SeatBook[reservationDayTimeSlot]"]:checked').val();
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