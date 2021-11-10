<link href='/assets/css/seat-style.css' rel='stylesheet'>
<link href='/assets/css/admin-editor.css' rel='stylesheet'>
<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

<div class="overlay">
    @section('content')
        <ol class="breadcrumb float-xl-right"></ol>
        <h5 class="text-center mt-40px page-subtitle">
            <a href='/'><i class="fas fa-chevron-left"></i></a>
            edit a room
            @if (Auth::check())
                <a><i class="fas fa-plus" onclick="addNewRoom()"></i></a>
            @else
                <a><i class="fas fa-plus"></i></a>
            @endif
        </h5>

        <div class="popup-container">
            <div class="popup-title">Are you sure?</div>
            <div class="popup-btn">
                <button onclick="closeWindow()">Cancel</button>
                <form id="confirm_delete" method="post">
                    @csrf
                    <button type='submit' value='submit'>Yes</button>
                </form>
            </div>
        </div>

        <div>
            <div class='d-flex flex-wrap justify-content-around mt-30px'>
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
                <div id="addNewRoom" style="display: none"></div>
            </div>
            @endsection
        </div>
