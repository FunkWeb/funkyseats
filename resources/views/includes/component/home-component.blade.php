<div class='text-center mt-30px home-container room-bg-color'>
    <a href="/room/{{ $id ?? '' }}" style='text-decoration: none; '>
    <div style='font-size:16px; font-weight: 600; text-transform: uppercase'>{{ $name }}</div>
    <div class="mt-4px" style='font-size:14px; text-transform: lowercase;'>
    @if ($seatCount != '1')
    available: {{ $seatCount }}
    @else
    no available seats
    @endif
    </div>
    </a>
</div>
