<link href='/assets/css/seat-style.css' rel='stylesheet'>

<div class='text-center text-light text-uppercase mt-30px seat-container' style="position: relative"
     onClick='bookSeat()'>
    @if ($seat->booking == '[]' && !Auth::check())
        <div class='available-seat seat-container'>
            @elseif ($seat->booking == '[]' && Auth::check())
                <div class='seat-bg-color seat-container'>
                    @elseif ( Auth::check() && (string)Auth::user()->id == $seat->booking[0]->user_id ?? '')
                        <div class='booked-by-me seat-container'>
                            @else
                                <div class='booked-seat seat-container'>
                                    @endif
                                    @if ($seat->booking != '[]' && Auth::check())
                                        @foreach($seat->booking as $booking)
                                            <div class="user-container-booked-seat">
                                                <div class="booked-time{{$seat->seat_number}} user-name-booked-seat">
                                                    @if (\Carbon\Carbon::parse($booking->from)->format('H') == 8 && \Carbon\Carbon::parse($booking->to)->format('H') == 16)
                                                        {{ 'All day' }}
                                                    @elseif (\Carbon\Carbon::parse($booking->from)->format('H') == 8)
                                                        {{ 'Before lunch' }}
                                                    @elseif(\Carbon\Carbon::parse($booking->from)->format('H') == 12)
                                                        {{ 'After lunch' }}
                                                    @endif
                                                </div>
                                                <div class="name-container">
                                                    <div class="user-name-booked-seat">{{ $booking->user->given_name }}</div>
                                                    <img src="{{ $booking->user->user_thumbnail ?? '' }}" class="user-picture-booked-seat">
                                                </div>
                                            </div>
                                            <div class='booked-seat-type-btn'>{{ $seat->seatType->name ?? '' }}</div>
                                        @endforeach
                                    @else
                                        <div class='seat-type-btn'>{{ $seat->seatType->name ?? '' }}</div>
                                    @endif
                                    <div class='seat-num'><b>Seat {{ $seat->seat_number ?? '' }}</b></div>
                                    @if ($seat->booking == '[]')
                                        <button class='booking-btn' onclick="book_seat({{ $seat->id ?? '' }})">Book seat
                                        </button>
                                    @endif
                                </div>
                        </div>
