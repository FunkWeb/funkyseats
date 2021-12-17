<div class='text-center text-uppercase mt-30px room-container'>
    @if (Auth::check())
    <div class='edit-box' style="pointer-events: all">
    @else
    <div class='edit-box' style="pointer-events: none">
    @endif
        <i class="far fa-trash-alt" onclick="showWindow({{$seat_id}}, 'seats', '{{ $seat_number ?? ''}}')"></i>
        <form action=/seats/{{ $seat_id ?? '' }}/save/ method="post">
            @csrf
            <select name="seat_type" class='edit-seat-type'>
                {{ $seat_types_list }}
            </select>
             <input type="text" id="seat_number " name="seat_number" 
                class='edit-seat-num' autofocus value='{{ $seat_number }}'>
            <button class='submit-changes-btn' type='submit' value='submit'>Save</button>
        </form>
    </div>
</div>
