<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

<div id="csrfNewRoom" style="hidden">
    @csrf
</div>

@error('name')
<div class="error-window">
    <p class="error-title"><b>Feilmelding</b></p>
    {{ $message }}
</div>
@enderror


<div class="overlay">
    @section('content')
        <ol class="breadcrumb float-xl-right"></ol>
        <!---------- header and add room ----->
        <h5 class="text-center mt-50px page-subtitle" id="room_head">
            <a href='/' class="back-arrow"><i class="fas fa-chevron-left"><p class="iTexts">tilbake</p></i></a>
            <strong>rediger rom</strong>
            @if (Auth::check())
                <a><i class="fas fa-plus" onclick="addNewRoom()"><p class="iTexts">legg til et rom</p></i></a> 
            @else
                <a><i class="fas fa-plus"><p class="iTexts">legg til et rom</p></i></a>
            @endif
        </h5>

        <div class="popup-container">
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
