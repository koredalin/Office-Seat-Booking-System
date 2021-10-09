$(document).ready(function () {
	collectOfficeSeats();
	
	$('#seatbook-officeid, #seatbook-booking_date, input[name="SeatBook[seat_book_time_slot_id]"]').on('change', function () {
		collectOfficeSeats();
	});
});

var collectOfficeSeats = function() {
	let officeId = ($('#seatbook-officeid').find(':selected').val() || '0').trim();
	let bookingDate = ($('#seatbook-booking_date').val() || '').trim();
	let timeSlotId = ($('input[name="SeatBook[seat_book_time_slot_id]"]:checked').val() || '0').trim();
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
		success: function (seats) {
			visualizeOfficeSeats(seats);
		},
		error: function (exception) {
			alert(exception);
		}
	});

	let visualizeOfficeSeats = function(seats) {
		let parsedSeats = JSON.parse(seats);
		let resultHtml = '';
		let allSeats = parsedSeats.allOfficeSeats || {};
		if ((Object.keys(allSeats).length || 0) === 0) {
			$('#no_office_seats').show();
			return;
		} else {
			$('#no_office_seats').hide();
		}
		let alreadyBookedSeats = parsedSeats.bookedOfficeSeats || [];
		$('div.field-seatbook-seat_id').show();
		$.each(allSeats, function (seatId, officeSeatId) {
			let disabledInput = (jQuery.inArray(parseInt(seatId || 0), alreadyBookedSeats) > -1
				|| jQuery.inArray(wholeWorkingDayBookId, alreadyBookedSeats) > -1)
				? ' disabled'
				: '';
			resultHtml += '<label>';
			resultHtml += '<input type="radio" name="SeatBook[seat_id]" value="'+seatId+'"'+disabledInput+'>';
			resultHtml += officeSeatId;
			resultHtml += '</label>';
		});
		$('#seatbook-seat_id').html(resultHtml);
	};
};