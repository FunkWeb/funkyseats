<link href='/assets/css/seat-style.css' rel='stylesheet'>

<div class='text-center text-light text-uppercase mt-30px seat-container' style="position: relative"
    onClick='bookSeat()'>
    @if ($booking == '[]' && !Auth::check())
        <div class='available-seat seat-container'>
        @elseif ($booking == '[]' && Auth::check())
            <div class='seat-bg-color seat-container'>
            @elseif ( Auth::check() && (string)Auth::user()->id == $booker_id ?? '')
                <div class='booked-by-me seat-container'>
                @else
                    <div class='booked-seat seat-container'>
    @endif
    @if ($user_picture ?? '' != '')
        <div class="user-container-booked-seat">
            <div class="booked-time user-name-booked-seat">
                <script>
                    let dateFrom = new Date('{{ $booked_from ?? '' }}').getUTCHours() + 1;
                    let dateTo = new Date('{{ $booked_to }}').getUTCHours() + 1;
                    console.log(dateFrom, dateTo);
                    if (dateTo == 12) {
                        document.getElementsByClassName('booked-time')[0].innerText = 'Before lunch';
                    }
                    if (dateFrom == 12) {
                        document.getElementsByClassName('booked-time')[0].innerText = 'After lunch';
                    }
                    if (dateFrom == 8 && dateTo == 16) {
                        document.getElementsByClassName('booked-time')[0].innerText = 'All day';
                    }
                </script>
            </div>
            <div class="name-container">
            <div class="user-name-booked-seat">{{ $user_name }}</div>
            <img src="{{ $user_picture ?? '' ?? '' }}" class="user-picture-booked-seat">
            </div>
        </div>
        <div class='booked-seat-type-btn'>{{ $type ?? '' }}</div>
    @else
        <div class='seat-type-btn'>{{ $type ?? '' }}</div>
    @endif
    <div class='seat-num'><b>Seat {{ $seat_number ?? '' }}</b></div>
    @if ($booking == '[]')
        <button class='booking-btn' onclick="book_seat({{ $seat_id ?? '' }})">Book seat
        </button>
    @endif
</div>
</div>
