function bookSeat() {
    //     document.getElementsByClassName('bookingWindow')[0].style.display = 'flex';
    //     document.getElementsByClassName('bookingWindow')[0].style.width = '216px';
    //     document.getElementsByClassName('bookingWindow').style.transition = 'all 1s';

}

function book_seat(seat_id) {
    document.seat_booking_form.action="/booking/seat/" + seat_id;
    document.seat_booking_form.submit();
    
}

function book_random_seat(room_id){
    document.seat_booking_form.action="/booking/seat/random/" + room_id;
    document.seat_booking_form.submit();
 }