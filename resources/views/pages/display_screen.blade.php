@component('includes.head')
@endcomponent

<script>
    function refreshPage(refreshRate) {
        setTimeout("location.reload(true);", refreshRate);
    }

    window.onload = refreshPage(5000 * 60);
</script>

{{-- {{ ddd($room[0]->seat[0]->booking[0]->user) }} --}}
<div class="panel panel-inverse" data-sortable-id="table-basic-1">

    <div class="panel-heading ui-sortable-handle" style="justify-content:center;">
        <h4>{{ $room[0]->name }} - {{ \Carbon\Carbon::now()->isoFormat('Do MMM Y') }}</h4>
    </div>

    <div class="panel-body">

        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Seat</th>
                        <th>Booked before lunch</th>
                        <th>Booked after lunch</th>
                        <th>Check in status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($room[0]->seat as $seat)
                        <tr>
                            <td>{{ $seat->seat_number }}</td>
                            @if (count($seat->booking) == 0)
                                <td></td>
                                <td></td>
                                <td></td>
                            @else
                                {{-- {{ ddd($seat->booking[0]) }} --}}
                                @foreach ($seat->booking as $booking)
                                    @if (\Carbon\Carbon::parse($booking->from)->format('H') == 8 && \Carbon\Carbon::parse($booking->to)->format('H') == 16)
                                        <td>{{ $booking->user->given_name ?? '' }}</td>
                                        <td>{{ $booking->user->given_name ?? '' }}</td>
                                        @if ($booking->checkin)
                                            <td> Checked in </td>
                                        @else
                                            <td> Not checked in </td>
                                        @endif
                                    @elseif(\Carbon\Carbon::parse($booking->from)->format('H') == 8)
                                        @if (\Carbon\Carbon::parse($booking->from)->format('H') == 12)
                                            <td>{{ $booking->user->given_name ?? '' }}</td>
                                            <td>{{ $booking->user->given_name ?? '' }}</td>
                                            @if ($booking->checkin)
                                                <td> Checked in </td>
                                            @else
                                                <td> Not checked in </td>
                                            @endif
                                        @else
                                            <td>{{ $booking->user->given_name ?? '' }}</td>
                                            <td></td>
                                            @if ($booking->checkin)
                                                <td> Checked in </td>
                                            @else
                                                <td> Not checked in </td>
                                            @endif
                                        @endif
                                    @elseif (\Carbon\Carbon::parse($booking->from)->format('H') == 12)
                                        <td></td>
                                        <td>{{ $booking->user->given_name ?? '' }}</td>
                                        @if ($booking->checkin)
                                            <td> Checked in </td>
                                        @else
                                            <td> Not checked in </td>
                                        @endif
                                    @endif
                                @endforeach
                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
