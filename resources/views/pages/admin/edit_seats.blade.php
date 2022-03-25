<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

<div id="csrfNewSeat" style="hidden">
    @csrf
</div>

@error('seat_type')
    <div class="error-window">
        <p class="error-title"><b>Error</b></p>
        {{ $message }}
    </div>
@enderror

@error('seat_number')
    <div class="error-window">
        <p class="error-title"><b>Error</b></p>
        {{ $message }}
    </div>
@enderror

<div class="overlay">
    @section('content')
        <ol class="breadcrumb float-xl-right"></ol>
        <!------------------header and add seat ------->
        <h4 class="fw-600 text-center mt-30px">{{ $room[0]->name }}</h4>
        <h5 class="text-center mt-10px page-subtitle">
            <a href='/rooms/edit' class="back-arrow">
                <i class="fas fa-chevron-left">
                    <p class="iTexts">back</p>
                </i>
            </a>
            <strong>edit a seat</strong>
            <a><i class="fas fa-plus admin-page" onclick="addNewSeat({{ $room[0]->id }}, {{ $types }})">
                    <p class="iTexts">add seat</p>
                </i></a>
        </h5>

        <div class="popup-container">

        </div>

        <div>
            <div id="addNewSeat" class='d-flex flex-wrap justify-content-around mt-20px'>
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
                                @if($type->id == $seat->seatType->id)
                                    <option selected value={{ $type->id }}>{{ $type->name }} </option>
                                @else
                                    <option value={{ $type->id }}>{{ $type->name }} </option>
                                @endif     
                            @endforeach
                        @endslot
                    @endcomponent
                @endforeach
            </div>
        @endsection
    </div>
</div>
