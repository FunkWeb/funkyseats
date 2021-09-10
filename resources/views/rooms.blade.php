<!DOCTYPE html>

<title>Funkyseats</title>

<body>
    @foreach ($rooms as $room)
        <div class='room'>
            <h4> Room name: {{ $room->name }} </h4>
            @foreach ($room->seat as $seat)
                <p>Seat type: {{ $seat->seatType->name }} , seat id: {{ $seat->id }} </p>
                <p>Seat Restrictions:</p>
                @foreach ($seat->seatRestriction as $restriction)
                    <small> {{ $restriction }} </small>
                    <br>
                @endforeach
                <p>Seat Equipment: </p>
                @foreach ($seat->seatEquipment as $equipment)
                    <small>{{ $equipment->name }}</small>
                    <br>
                @endforeach

            @endforeach

    @endforeach

</body>
