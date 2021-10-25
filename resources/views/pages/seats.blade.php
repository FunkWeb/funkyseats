<link href='/assets/css/seat-style.css' rel='stylesheet'>
<script src='/assets/js/seat-booking.js' type='text/javascript'></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
    <ol class="breadcrumb float-xl-right"></ol>
    @error('user_id')
    <div class="error-window">{{ $message }} </div>
    @enderror
    <h3 class="fw-800 text-center mt-30px">{{ $room[0]->name }}</h3>
    <h5 class="text-center mt-10px position-relative" style="color: #9f9e9e">
        <a href='/'><i class="fas fa-chevron-left" style='position: absolute; left: 64px; color: #9f9e9e'></i></a>
        choose a seat
    </h5>
    <div>
        <div class='d-flex flex-wrap justify-content-around mt-20px'>
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
                    @endcomponent
                @endforeach
        </div>
        <!-- <div class='position-absolute bookingWindow'>Hei<div> -->
    @endsection
