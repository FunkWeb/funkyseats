@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
    <h4 class="fw-800 text-center mt-30px">{{ $room[0]->name }}</h4>
    <h5 class="text-center mt-10px position-relative" style="color: #20B3BE">
        <a href='/'><i class="fas fa-chevron-left position-absolute" style='left: 64px; color: #9f9e9e'></i></a>
    </h5>
    <div class="mx-40px mt-40px d-flex flex-wrap justify-content-around">
        @foreach ($room[0]->seat as $seat)
            @component('includes.component.seat-display-component')
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
                @slot('user_picture')
                    {{ $seat->booking[0]->user->user_thumbnail ?? '' }}
                @endslot
                @slot('user_name')
                    {{ $seat->booking[0]->user->given_name ?? '' }}
                @endslot
                @slot('booked_from')
                    {{ $seat->booking[0]->from ?? '' }}
                @endslot
                @slot('booked_to')
                    {{ $seat->booking[0]->to ?? '' }}
                @endslot
            @endcomponent
        @endforeach
    </div>
@endsection
