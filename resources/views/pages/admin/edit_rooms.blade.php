<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

<div id="csrfNewRoom" style="hidden">
    @csrf
</div>

@error('name')
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

<div class="overlay">
    @section('content')
        <ol class="breadcrumb float-xl-right"></ol>
        <h5 class="text-center mt-40px page-subtitle">
            <a href='/'><i class="fas fa-chevron-left"></i><p class="iTexts">back</p></a>
            edit a room
            @if (Auth::check())
                <a><i class="fas fa-plus" onclick="addNewRoom()"></i><p class="iTexts">add room</p></a> 
            @else
                <a><i class="fas fa-plus"></i><p>add room</p class="iTexts"></a>
            @endif
        </h5>

        <div class="popup-container">
            <div class="popup-title"></div>
            <div class="popup-btn">
                <button onclick="closeWindow()">Cancel</button>
                <form id="confirm_delete" method="post">
                    @csrf
                    <button type='submit' value='submit'>Yes</button>
                </form>
            </div>
        </div>

        <div>
            <div id="addNewRoom" class='d-flex flex-wrap justify-content-around mt-30px'>
                @foreach ($rooms as $room)
                    @component('includes.component.room-editing')
                        @slot('id')
                            {{ $room->id }}
                        @endslot
                        @slot('name')
                            {{ $room->name }}
                        @endslot
                        @slot('seatCount')
                            {{ $room->seat_count }}
                        @endslot
                    @endcomponent
                @endforeach
            </div>
            @endsection
        </div>
</div>
