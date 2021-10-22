<link href='/assets/css/seat-style.css' rel='stylesheet'>
<script src='/assets/js/seat-booking.js' type='text/javascript'></script>

<div class='text-center text-light text-uppercase mt-30px seat-container' onClick='bookSeat()'>
    @if ($booking == '[]' && !Auth::check())
            <div class='available-seat'>
        @elseif ($booking == '[]' && Auth::check())
            <div class='seat-bg-color'>
        @else
            <div class='booked-seat'>
    @endif
    <div class='seat-type-btn'>{{ $type ?? '' }}</div>
    <div class='seat-num'><b>Seat {{ $seat_number ?? '' }}</b></div>
    @if ($booking == '[]')
        <form action=/booking/seat/{{ $seat_id ?? '' }} method="post">
            @csrf
            <button class='booking-btn' type='submit' value='submit'> Book a seat </button>
        </form>
    @endif
</div>
</div>
