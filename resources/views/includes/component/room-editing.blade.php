<div class='text-center text-light text-uppercase mt-30px box-style'
     style="background-image: url({{ asset('images/office.jpeg') }})">
        <div class="edit-box">
            <i class="far fa-trash-alt" onclick="deleteRoom()"></i>
            <input value={{ $name }}>
            <a href="/room/{{ $id ?? '' }}/seats/edit" style='text-decoration: none;'>
            <form action=/booking/seat/{{ $seat_id ?? '' }} method="post">
            @csrf
            <button class='submit-changes-btn' type='submit' value='submit'> Update </button>
            </form>
            </a>
        </div>
</div>
