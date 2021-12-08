<div class='text-center text-uppercase mt-30px room-container'>
    @if (Auth::check())
    <div class="edit-box" style="pointer-events: all">
    @else
    <div class="edit-box" style="pointer-events: none">
    @endif
        <i class="far fa-trash-alt" onclick="showWindow({{$id}}, 'rooms')"></i>
        <form action=/rooms/{{ $id ?? '' }}/save method="post">
            @csrf
            <input class="text-dark" type="text" id="name" name="name" value={{ $name }}>
            <button class='submit-changes-btn' type='submit' value='submit'>Update</button>
        </form>
    </div>
</div>
