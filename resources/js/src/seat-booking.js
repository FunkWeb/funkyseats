function bookSeat() {
    //     document.getElementsByClassName('bookingWindow')[0].style.display = 'flex';
    //     document.getElementsByClassName('bookingWindow')[0].style.width = '216px';
    //     document.getElementsByClassName('bookingWindow').style.transition = 'all 1s';

}

function book_seat(seat_id, timeInterval) {
    if (!timeInterval) {
        document.seat_booking_form.action = "/booking/seat/" + seat_id;
        document.seat_booking_form.submit();
    }
    else {
        timeInterval.checked = true;
        document.seat_booking_form.action = "/booking/seat/" + seat_id;
        document.seat_booking_form.submit();
    }

}

function book_random_seat(room_id) {
    document.seat_booking_form.action = "/booking/seat/random/" + room_id;
    document.seat_booking_form.submit();
}


function displayMap() {
    let map = document.querySelector('.seats-map');
    if(map.classList.contains('hidden')){
        map.classList.remove('hidden');
    }
    else{
        map.classList.add('hidden');
    }
    
}

const span = document.querySelector('.close');
span.onclick = function () {
    document.querySelector('.seats-map').classList.add('hidden');
}

$(document).ready(function () {
    const radios = document.getElementsByName('book_time');
    const val = localStorage.getItem('funkyseats_booking_time');
    for (let i = 0; i < radios.length; i++) {
        if (radios[i].value === val) {
            radios[i].checked = true;
        }
    }
    $('input[name="book_time"]').on('change', function () {
        localStorage.setItem('funkyseats_booking_time', $(this).val());
    });
});
