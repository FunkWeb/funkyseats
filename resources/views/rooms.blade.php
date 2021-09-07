<!DOCTYPE html>

<title>Funkyseats</title>

<body>
    @foreach ($rooms as $room)
        <div class='room'>
            <h4> Room name: {{ $room->name }} </h4>
            @foreach ($room->seat as $seat)

                <p>Seat type: {{ $seat->seatType->name }} , seat number: {{ $seat->seat_number }} </p>

            @endforeach

    @endforeach

</body>
