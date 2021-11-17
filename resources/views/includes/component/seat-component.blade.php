<link href='/assets/css/seat-style.css' rel='stylesheet'>

<div class='text-center text-light text-uppercase mt-30px seat-container' style="position: relative" onClick='bookSeat()'>
    @if ($booking == '[]' && !Auth::check())
            <div class='available-seat seat-container'>
        @elseif ($booking == '[]' && Auth::check())
            <div class='seat-bg-color seat-container'>
        @elseif ( Auth::check() && (string)Auth::user()->id ==  $booker_id ?? '')
            <div class='booked-by-me seat-container'>
        @else
            <div class='booked-seat seat-container'>
    @endif
               @if ($user_picture != '')
                    <div class="user-container-booked-seat">
                        <div class="user-name-booked-seat">{{ $user_name }}</div>
                        <img src="{{ $user_picture }}" class="user-picture-booked-seat">
                    </div>
                @endif
    <div class='seat-type-btn'>{{ $type ?? '' }}</div>
    <div class='seat-num'><b>Seat {{ $seat_number ?? '' }}</b></div>
    @if ($booking == '[]')
        <form action=/booking/seat/{{ $seat_id ?? '' }} method="post">
            @csrf
            <button class='booking-btn' type='submit' value='submit'>Book a seat</button>
        </form>
    @endif
</div>
</div>
<div class="book-calendar" style="position: absolute">
    <form>
    <input type="date" id="start" min="2021-11-01" max="2022-12-31">
    <label>
        <input type="radio">
        Before lunch
    </label>
    <label>
        <input type="radio">
        After lunch
    </label>
    <label>
        <input type="radio" checked>
        All day
    </label>
    </form>
</div>
