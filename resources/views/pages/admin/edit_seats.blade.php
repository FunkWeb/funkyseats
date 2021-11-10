<link href='/assets/css/seat-style.css' rel='stylesheet'>
<link href='/assets/css/admin-editor.css' rel='stylesheet'>
<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

<div id="csrfNewSeat" style="visibility: hidden">
    @csrf
</div>
@error('seat_type')
<div class="error-window">
    <p class="error-title"><b>Error</b></p>
    {{ $message }}
</div>
@enderror
<div class="overlay">
    @section('content')
        <ol class="breadcrumb float-xl-right"></ol>
        <h4 class="fw-600 text-center mt-30px">{{ $room[0]->name }}</h4>
        <h5 class="text-center mt-10px page-subtitle">
            <a href='/rooms/edit'><i class="fas fa-chevron-left"></i></a>
            edit a seat
            @if (Auth::check())
                <a><i class="fas fa-plus" onclick="addNewSeat()"></i></a>
            @else
                <a><i class="fas fa-plus"></i></a>
            @endif
        </h5>

        <div class="popup-container">
            <div class="popup-header">
                <div class="popup-title">Are you sure?</div>
            </div>
            <div class="popup-btn">
                <button onclick="closeWindow()">Cancel</button>
                <form id="confirm_delete" method="post">
                    @csrf
                    <button type='submit' value='submit'>Yes</button>
                </form>
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
                <div id="addNewSeat" style="display: none"></div>
            </div>
            @endsection
        </div>
