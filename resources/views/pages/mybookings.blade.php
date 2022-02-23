<script src={{ asset('assets/js/admin-page.js') }} defer></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
    <div class="my-bookings-title">
        my bookings
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
                        <th>Check-in</th>
                        <th>Cancel</th>
                    </tr>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>
                                {{$booking->seat->room->name}}<br>
                                Seat #{{$booking->seat->seat_number}}
                            </td>
                            <td>
                                <div>{{\Carbon\Carbon::parse($booking->from)->toDateString()}}</div>
                                @if (\Carbon\Carbon::parse($booking->from)->format('H') == 8 && \Carbon\Carbon::parse($booking->to)->format('H') == 16)
                                    <div>all day</div>
                                @elseif (\Carbon\Carbon::parse($booking->from)->format('H') == 8)
                                    <div>before lunch</div>
                                @elseif(\Carbon\Carbon::parse($booking->to)->format('H') == 16)
                                    <div>after lunch</div>
                                @endif
                            </td>
                            <td>
                                @if ((string) Auth::user()->id == $booking->user->id)
                                    <a href={{ route('deleteBooking', ['booking_id' => $booking->id]) }}>
                                        <button class="reject-btn">Cancel</button>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
    @endif
@endsection
