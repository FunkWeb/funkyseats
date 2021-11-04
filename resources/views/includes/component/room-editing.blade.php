<div class='text-center text-light text-uppercase mt-30px box-style'
    style="background-image: url({{ asset('images/office.jpeg') }})">
    @if (Auth::check())
    <div class="edit-box" style="pointer-events: all">
    @else
    <div class="edit-box" style="pointer-events: none">
    @endif
        <i class="far fa-trash-alt" style="cursor: pointer" onclick="showWindow({{$id}}, 'rooms')"></i>
        {{-- <a href="/room/{{ $id ?? '' }}/seats/edit" style='text-decoration: none;'> --}}
        <form action=/rooms/{{ $id ?? '' }}/save method="post">
            @csrf
            <input type="text" id="name" name="name" value={{ $name }}>
            <button class='submit-changes-btn' type='submit' value='submit'>Update</button>
        </form>
        </a>
    </div>
</div>
