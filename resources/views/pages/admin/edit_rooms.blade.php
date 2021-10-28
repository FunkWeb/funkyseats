<link href='/assets/css/seat-style.css' rel='stylesheet'>
<link href='/assets/css/admin-editor.css' rel='stylesheet'>
<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
<ol class="breadcrumb float-xl-right"></ol>
<h5 class="text-center mt-10px position-relative" style="color: #9f9e9e">
    <a href='/rooms/edit'><i class="fas fa-chevron-left" style='position: absolute; left: 64px; color: #9f9e9e'></i></a>
    Edit room
</h5>
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
    </div>
    @endsection
