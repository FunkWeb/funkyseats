<div class='text-center text-light text-uppercase mt-30px' style="width: 224px; height: 160px; background-image: url({{ asset('images/office.jpeg') }}); cursor: pointer; border-radius: 5%; border: none ">
    <a href="/room/{{ $id ?? '' }}" style='text-decoration: none;'>
    <div  style='width: 224px; height: 160px;'>
    <div style='font-size:16px; padding-top: 62px; color:white;'>{{ $name }}</div>
    <div style='font-size:14px; padding-top: 10px; color:white; text-transform: lowercase;'>
    @if ($seatCount != '1')
    available: {{ $seatCount }}
    @else
    no available seats
    @endif
    </div>
    </div>
    </a>
</div>
