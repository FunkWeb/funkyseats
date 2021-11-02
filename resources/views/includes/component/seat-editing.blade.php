<div class='text-center text-light text-uppercase mt-30px seat-container admin-seat-bg-color'
    style="background-image: url({{ asset('images/office.jpeg') }})">
    <div>
        <i class="far fa-trash-alt" onclick="deleteSeat()"></i>
        <form action=/seats/{{ $seat_id ?? '' }}/save/ method="post">
            @csrf
            <select name="seat_type" class='edit-seat-type'>
                {{ $seat_types_list }}
            </select>
            <br>
            seat number <input type="text" id="seat_number" name="seat_number" class='edit-seat-num'
                value='{{ $seat_number }}'>
            <button class='submit-changes-btn' type='submit' value='submit'> Update </button>
        </form>
    </div>
</div>
