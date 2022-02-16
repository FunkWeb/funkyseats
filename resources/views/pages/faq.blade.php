<script src={{ asset('assets/js/seat-booking.js') }} defer></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
    <div class="faq-container">
        <div class="faq-title">Frequently asked questions (FAQ)</div>
        <div class="faq-content">
            @foreach ($faqs as $faq)
                @component('includes.component.faq')
                    @slot('question')
                        {{ $faq->question }}
                    @endslot
                    @slot('answer')
                        {{ $faq->answer }}
                    @endslot
                @endcomponent
            @endforeach
        </div>
    </div>
@endsection
