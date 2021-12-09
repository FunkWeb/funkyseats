<script src="/assets/js/seat-booking.js" defer></script>

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
                <Example date_selected={{ $date_selected }} room_id={{ $room[0]->id }} />
            </div>
            <div>
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
            </div>
        </form>
    </div>
    <div class="mx-40px">
        <div class='d-flex flex-wrap justify-content-around'>
            @foreach ($room[0]->seat as $seat)
                <x-seat_component :seat="$seat" :user="Auth::user()"></x-seat_component>
            @endforeach
        </div>
        <script defer src="{{ mix('assets/js/manifest.js') }}"></script>
        <script defer src="{{ mix('assets/js/vendor.js') }}"></script>
        <script defer src="{{ mix('assets/js/react_app.js') }}"></script>

    @endsection
