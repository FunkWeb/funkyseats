<div class='text-center text-light text-uppercase mt-30px room-container'>
    @if (Auth::check())
    <div class='edit-box' style="pointer-events: all">
    @else
    <div class='edit-box' style="pointer-events: none">
    @endif
        <i class="far fa-trash-alt" onclick="showWindow({{$seat_id}}, 'seats')"></i>
        <form action=/seats/{{ $seat_id ?? '' }}/save/ method="post">
            @csrf
            <select name="seat_type" class='edit-seat-type text-dark'>
                {{ $seat_types_list }}
            </select>
             <input type="text" id="seat_number" name="seat_number" class='edit-seat-num'
                value='seat {{ $seat_number }}'>
            <button class='submit-changes-btn' type='submit' value='submit'>Update</button>
        </form>
    </div>
</div>
