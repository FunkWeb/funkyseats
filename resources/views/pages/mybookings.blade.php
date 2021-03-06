<script src={{ asset('assets/js/seat-booking.js') }} defer></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
    <div class="my-bookings-title">
        My bookings
    </div>
    @if (count($bookings) == 0)
        <div class="no-bookings-message">You have no bookings</div>
        <a href="/">
            <button class="mt-20px booking-btn book_any_btn">Book a seat</button>
        </a>
    @else
        <div class="my-bookings-container">
            <div class="mt-10px request-list">
                <table>
                    <tr class="booking-columns-description">
                        <th>Room</th>
                        <th>Date</th>
                        <th>View</th>
                        <th>Cancel</th>
                    </tr>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>
                                {{ $booking->seat->room->name }}<br>
                                Seat #{{ $booking->seat->seat_number }}
                            </td>
                            <td>
                                <div>{{ \Carbon\Carbon::parse($booking->from)->isoFormat('Do MMM Y') }}</div>
                                @if (\Carbon\Carbon::parse($booking->from)->format('H') == 8 && \Carbon\Carbon::parse($booking->to)->format('H') == 16)
                                    <div>all day</div>
                                @elseif (\Carbon\Carbon::parse($booking->from)->format('H') == 8)
                                    <div>before lunch</div>
                                @elseif(\Carbon\Carbon::parse($booking->to)->format('H') == 16)
                                    <div>after lunch</div>
                                @endif
                            </td>
                            @if ((string) Auth::user()->id == $booking->user->id)
                                <td>
                                    <a
                                        href='/room/{{ $booking->seat->room->id }}/{{ \Carbon\Carbon::parse($booking->from)->format('j-n-Y') }}'>
                                        <button class="booking-btn display-block">View</button>
                                    </a>
                                </td>
                                <td>
                                    <a href={{ route('booking.destroy', ['booking' => $booking->id]) }}>
                                        <button class="booking-btn display-block">Cancel</button>
                                    </a>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                </table>

                <div class="row expand">
                    <i class="fas fa-chevron-right" id="expand"
                        onclick="displayPrevBookings(document.querySelector('.previousBookings'), document.getElementById(this.id))">
                        <strong>Show previous bookings</strong>
                    </i>
                </div>

                <div class="previousBookings hidden">
                    <table>
                        <tr class="booking-columns-description previous">
                            <th>Room</th>
                            <th>Date</th>
                        </tr>
                        @foreach ($bookings_old as $booking)
                            <tr>
                                <td>
                                    {{ $booking->seat->room->name }}<br>
                                    Seat #{{ $booking->seat->seat_number }}
                                </td>
                                <td>
                                    <div>{{ \Carbon\Carbon::parse($booking->from)->isoFormat('Do MMM Y') }}</div>
                                    @if (\Carbon\Carbon::parse($booking->from)->format('H') == 8 && \Carbon\Carbon::parse($booking->to)->format('H') == 16)
                                        <div>all day</div>
                                    @elseif (\Carbon\Carbon::parse($booking->from)->format('H') == 8)
                                        <div>before lunch</div>
                                    @elseif(\Carbon\Carbon::parse($booking->to)->format('H') == 16)
                                        <div>after lunch</div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection
