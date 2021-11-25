<link href='/assets/css/seat-style.css' rel='stylesheet'>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
    <ol class="breadcrumb float-xl-right"></ol>
    @error('user_id')
        <div class="error-window">
            <p class="error-title"><b>Error</b></p>
            {{ $message }}
        </div>
    @enderror
    @if (session('success'))
        <div class="booked-seat-successfully">
            <p class="success-title"><b>Great job!</b></p>
            {{ session('success') }}
        </div>
    @endif
    <h4 class="fw-800 text-center mt-30px">{{ $room[0]->name }}</h4>
    <h5 class="text-center mt-10px position-relative" style="color: #20B3BE">
        <a href='/'><i class="fas fa-chevron-left position-absolute" style='left: 64px; color: #9f9e9e'></i></a>
        choose a seat
    </h5>

    <div class="book-calendar">
        <form name="seat_booking_form" method="POST">
            @csrf
            <div class="book-calendar">
                <Example value={{ $date_selected }} room_id={{ $room[0]->id }} />
            </div>
            <label>
                <input type="radio" name="book_time" value="0">
                Before lunch
            </label>
            <label>
                <input type="radio" name="book_time" value="1">
                After lunch
            </label>
            <label>
                <input type="radio" name="book_time" value="2" checked>
                All day
            </label>
        </form>
    </div>
    <div class="mx-40px">
        <div class='d-flex flex-wrap justify-content-around'>
            @foreach ($room[0]->seat as $seat)
                @component('includes.component.seat-component')
                    @slot('type')
                        {{ $seat->seatType->name }}
                    @endslot
                    @slot('seat_number')
                        {{ $seat->seat_number }}
                    @endslot
                    @slot('booking')
                        {{ $seat->booking }}
                    @endslot
                    @slot('seat_id')
                        {{ $seat->id }}
                    @endslot
                    @slot('booker_id')
                        {{ $seat->booking[0]->user_id ?? '' }}
                    @endslot
                    @slot('user_picture')
                        {{ $seat->booking[0]->user->user_thumbnail ?? '' }}
                    @endslot
                    @slot('user_name')
                        {{ $seat->booking[0]->user->given_name ?? '' }}
                    @endslot
                @endcomponent
            @endforeach
        </div>
        <script type='text/javascript' src='/assets/js/seat-booking.js'></script>
        <script defer src="{{ mix('assets/js/manifest.js') }}"></script>
        <script defer src="{{ mix('assets/js/vendor.js') }}"></script>
        <script defer src="{{ mix('assets/js/react_app.js') }}"></script>
    @endsection
