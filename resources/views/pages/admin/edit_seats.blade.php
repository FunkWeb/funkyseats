<link href='/assets/css/seat-style.css' rel='stylesheet'>
<link href='/assets/css/admin-editor.css' rel='stylesheet'>
<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

<div class="overlay">
@section('content')
    <ol class="breadcrumb float-xl-right"></ol>
    <h3 class="fw-800 text-center mt-30px">{{ $room[0]->name }}</h3>
    <h5 class="text-center mt-10px position-relative" style="color: #9f9e9e">
        <a href='/rooms/edit'><i class="fas fa-chevron-left"
                style='position: absolute; left: -648px; color: #9f9e9e'></i></a>
        Edit a seat
    </h5>

    <div class="popup-container">
        <div class="popup-header">
            <div class="popup-title">Are you sure?</div>
        </div>
        <div class="popup-btn">
            <button onclick="closeWindow()">Cancel</button>
            <button href="url/route/seat/{{$id ?? ''}}/delete" onclick="deleteSeat()">Yes</></button>
        </div>
    </div>

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
                    @slot('seat_types_list')
                        @foreach ($types as $type)
                            <option value={{ $type->id }}>{{ $type->name }} </option>
                        @endforeach
                    @endslot

                @endcomponent
            @endforeach
        </div>
    @endsection
    </div>
