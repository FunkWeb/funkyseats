@component('includes.head')
@endcomponent

<script>
    function refreshPage(refreshRate){
        setTimeout("location.reload(true);", refreshRate);
    }

    window.onload = refreshPage(5000 * 60);

</script>

<div class="panel panel-inverse" data-sortable-id="table-basic-1">

    <div class="panel-heading ui-sortable-handle" style="justify-content:center;">
    <h4>{{$room[0]->name}}</h4>
    </div>
    
    <div class="panel-body">
    
    <div class="table-responsive">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>Seat</th>
                <th>Booked before lunch</th>
                <th>Booked after lunch</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($room[0]->seat as $seat)
        <tr>
            <td>{{ $seat->seat_number }}</td>
            @if($seat->booking == '[]')
                <td></td>
                <td></td>
            @else
                @foreach($seat->booking as $booking)
                    @if (\Carbon\Carbon::parse($booking->from)->format('H') == 8 
                    && \Carbon\Carbon::parse($booking->to)->format('H') == 16)
                    <td>{{$booking->user->given_name ?? ''}}</td>
                    <td>{{$booking->user->given_name ?? ''}}</td>
                    
                    @elseif(\Carbon\Carbon::parse($booking->from)->format('H') == 8 )
                        @if (\Carbon\Carbon::parse($booking->from)->format('H') == 12 )
                            <td>{{$booking->user->given_name ?? ''}}</td>
                            <td>{{$booking->user->given_name ?? ''}}</td>
                        @else
                            <td>{{$booking->user->given_name ?? ''}}</td>
                            <td></td>
                        @endif
                    @elseif (\Carbon\Carbon::parse($booking->from)->format('H') == 12 )
                            <td></td>
                            <td>{{$booking->user->given_name ?? ''}}</td>
                            
                    @endif
                @endforeach
            @endif
                
        </tr>
            @endforeach
        </tbody>
    </table>
</div>

    


       
