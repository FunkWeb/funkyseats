<link href='/assets/css/seat-style.css' rel='stylesheet'>
<script src='/assets/js/seat-booking.js' type='text/javascript'></script>

<div class='text-center text-light text-uppercase mt-30px seat-container' onClick='bookSeat()'>
                <div class='seat-bg-color'>
                    <div class='pt-30px'>{{ $type ?? '' }}</div>
                    <div class='seat-num'><b>Seat {{ $seat_number ?? '' }}</b></div>
                    <form> <button class='booking-btn' type='submit'>Book a seat</button> </form>
                </div>
</div>

