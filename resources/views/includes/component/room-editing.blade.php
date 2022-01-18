<div class='text-center text-uppercase mt-30px room-container'>
    @if (Auth::check())
    <div class="edit-box" style="pointer-events: all">
    @else
    <div class="edit-box" style="pointer-events: none">
    @endif
        <i class="far fa-trash-alt fa-lg" onclick="showWindow({{$id}}, 'rooms', '{{ $name }}')">
        </i>

        <form action=/rooms/{{ $id ?? '' }}/save method="post">
            @csrf
            <input class="roomText" type="text" id="name" name="name" autofocus value={{ $name }}>
            <button class='submit-changes-btn' type='submit' value='submit'>Update</button>
        </form>
    </div>
</div>
