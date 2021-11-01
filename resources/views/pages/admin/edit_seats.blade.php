<link href='/assets/css/seat-style.css' rel='stylesheet'>
<link href='/assets/css/admin-editor.css' rel='stylesheet'>
<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
    <ol class="breadcrumb float-xl-right"></ol>
    <h3 class="fw-800 text-center mt-30px">{{ $room[0]->name }}</h3>
    <h5 class="text-center mt-10px position-relative" style="color: #9f9e9e">
        <a href='/rooms/edit'><i class="fas fa-chevron-left"
                style='position: absolute; left: -648px; color: #9f9e9e'></i></a>
        Edit a seat
    </h5>
    <div>
        <div class='d-flex flex-wrap justify-content-around mt-20px'>
            @foreach ($room[0]->seat as $seat)
                @component('includes.component.seat-editing')
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
