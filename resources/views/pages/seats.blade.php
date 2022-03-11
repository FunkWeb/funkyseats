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

    @if (session('error'))
        <div class="error-window">
            <p class="error-title"><b>Error</b></p>
            {{ session('error')}}
        </div>
    @endif

    @if (session('success'))
        <div class="booked-seat-successfully">
            <p class="success-title"><b>Great job!</b></p>
            {{ session('success') }}
        </div>
    @endif

    <h4 class="fw-800 text-center mt-20px">{{ $room[0]->name }}</h4>
    <h5 class="text-center mt-10px position-relative" style="color: #20B3BE">
        <a href='/'><i class="fas fa-chevron-left position-absolute icon-left"></i></a>
        choose a seat
    </h5>

    <div class="book-calendar">
        <form name="seat_booking_form" method="POST">
            @csrf
            <div class="book-calendar">
                <Example date_selected={{ $date_selected }} room_id={{ $room[0]->id }} />
            </div>
            <div class="d-flex" style="align-items: center">
                <input type="radio" id="before_lunch" name="book_time" value="0">
                    <label for="before_lunch">Before lunch</label>
                <input type="radio" id="after_lunch" name="book_time" value="1">
                    <label for="after_lunch">After lunch</label>
                <input type="radio" id="all_day" name="book_time" value="2" checked>
                    <label for="all_day">All day</label>
            </div>
        </form>

        
    </div>
    <div class="mapAnyRow">
        @if (Auth::check())
                <button class='booking-btn book_any_btn' onclick="book_random_seat({{ $room[0]->id ?? '' }})">Book any seat
                </button>
                <button class="booking-btn book_any_btn" onclick="displayMap()">
                     Seats map
                </button>    
        @endif
    </div>
    
        
        <div class="seats-map hidden">
            <div class="row"><span class="close">&times;</span></div>
            <img src="{{ asset('images/seatMaps/'.$room[0]->id.'.png') }}" alt="No seat map available">
        </div>
   
    <div class="mx-40px">
        <div class='d-flex flex-wrap justify-content-around'>
            @foreach ($room[0]->seat as $seat)
                <x-seat_component :seat="$seat" :user="Auth::user()"></x-seat_component>
            @endforeach
        </div>
    </div>
        <script defer src="{{ mix('assets/js/manifest.js') }}"></script>
        <script defer src="{{ mix('assets/js/vendor.js') }}"></script>
        <script defer src="{{ mix('assets/js/react_app.js') }}"></script>
@endsection
