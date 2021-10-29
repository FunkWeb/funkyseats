<div class='text-center text-light text-uppercase mt-30px seat-container admin-seat-bg-color'
     style="background-image: url({{ asset('images/office.jpeg') }})">
    <div>
        <i class="far fa-trash-alt" onclick="deleteSeat()"></i>
        <select class='edit-seat-type'>
            <option>{{ $type }} </option>
        </select>
        <input class='edit-seat-num' value='Seat {{ $seat_number}}'>
        <button class='submit-changes-btn' type='submit' value='submit'> Update </button>
    </div>
</div>
