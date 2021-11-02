<div class='text-center text-light text-uppercase mt-30px box-style'
    style="background-image: url({{ asset('images/office.jpeg') }})">
    <div class="edit-box">
        <i class="far fa-trash-alt" onclick="deleteRoom()"></i>
        {{-- <a href="/room/{{ $id ?? '' }}/seats/edit" style='text-decoration: none;'> --}}
        <form action=/rooms/{{ $id ?? '' }}/save method="post">
            @csrf
            <input type="text" id="name" name="name" value={{ $name }}>
            <button class='submit-changes-btn' type='submit' value='submit'> Update </button>
        </form>
        </a>
    </div>
</div>
