<div class='text-center text-light text-uppercase mt-30px seat-container' onClick='bookSeat()'>
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
                                        <div>{{ $seat->seatType->name ?? '' }}</div>
                                    @else
                                        <div class='seat-type-btn'>{{ $seat->seatType->name ?? '' }}</div>
                                    @endif
                                    <div class='seat-num'><b>Seat {{ $seat->seat_number ?? '' }}</b></div>
                                    @if ($seat->booking == '[]')
                                        <button class='booking-btn' onclick="book_seat({{ $seat->id ?? '' }})">Book a seat
                                        </button>
                                        @else
                                        <a href={{ route('deleteBooking', ['booking_id' => $seat->booking[0]->id]) }} class="booking-btn">
                                            <button class='booking-btn' href="">Cancel booking</button>
                                        </a>
                                    @endif
                                    @if ($seat->booking != '[]' && Auth::check())
                                        @foreach($seat->booking as $booking)
                                            <div style="display: flex; justify-content: space-evenly;">
                                                    <div class="booked-time{{$seat->seat_number}} user-name-booked-seat">
                                                        @if (\Carbon\Carbon::parse($booking->from)->format('H') == 8 && \Carbon\Carbon::parse($booking->to)->format('H') == 16)
                                                            <div class="user-booking-info">
                                                                <div class="d-flex flex-row">
                                                                    <div class="mr-6px"><img src="{{ $booking->user->user_thumbnail ?? '' }}" class="user-picture-booked-seat"></div>
                                                                    <div class="mx-6px my-auto">{{ $booking->user->given_name }}</div>
                                                                </div>
                                                                <div>{{ 'All day' }}</div>
                                                            </div>
                                                        @elseif (\Carbon\Carbon::parse($booking->from)->format('H') == 8)
                                                            <div class="user-booking-info">
                                                                <div><img src="{{ $booking->user->user_thumbnail ?? '' }}" class="user-picture-booked-seat"></div>
                                                                <div>
                                                                    <div> {{ $booking->user->given_name }}</div>
                                                                    <div>{{ 'Before lunch' }}</div>
                                                                </div>
                                                            </div>
                                                        @elseif(\Carbon\Carbon::parse($booking->to)->format('H') == 16)
                                                            <div class="user-booking-info">
                                                                <div><img src="{{ $booking->user->user_thumbnail ?? '' }}" class="user-picture-booked-seat"></div>
                                                                <div>
                                                                    <div> {{ $booking->user->given_name }}</div>
                                                                    <div>{{ 'After lunch' }}</div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                </div>
                                        @endforeach
                                    @endif
                                </div>
                        </div>
