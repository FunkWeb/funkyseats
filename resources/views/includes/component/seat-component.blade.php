<link href='/assets/css/seat-style.css' rel='stylesheet'>
<script src='/assets/js/seat-booking.js' type='text/javascript'></script>

<div class='text-center text-light text-uppercase mt-30px seat-container' onClick='bookSeat()'>
                @if ($booking == '[]')
                <div class='seat-bg-color'>
                @else
                <div class='booked-seat'>
                @endif
                    <div class='seat-type-btn'>{{ $type ?? '' }}</div>
                    <div class='seat-num'><b>Seat {{ $seat_number ?? '' }}</b></div>
                    @if ($booking == '[]')
                    <form><button class='booking-btn' type='submit'> Book a seat </button></form>
                    @endif
                </div>
</div>

