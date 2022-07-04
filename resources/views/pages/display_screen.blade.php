
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$room[0]->name}}</title>
    <meta http-equiv="refresh" content="600">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<script>
    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        h = checkTime(h);
        m = checkTime(m);
        document.getElementById('time').innerHTML =
            h + ":" + m;
        var t = setTimeout(startTime, 1000);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }
        ;  // add zero in front of numbers < 10
        return i;
    }
    
</script>

<body class="py-4 px-20 bg-indigo-50" onload="startTime()">
<div class="flex justify-between py-12 text-4xl font-bold text-center text-gray-700">
    <div>{{$room[0]->name}}</div>
    <div id="time"></div>
</div>

<div class="relative overflow-x-auto shadow-2xl sm:rounded-lg">
    <table class="w-full text-2xl text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">Plass nr</th>
            <th scope="col" class="px-6 py-3">Person</th>
            <th scope="col" class="px-6 py-3">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($room[0]->seat as $seat)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    {{ $seat->seat_number}}
                </th>
                 @if(count($seat->booking) !== 0)
                    @foreach($seat->booking as $booking)
                        @if(\Carbon\Carbon::parse ($booking->from)->format('H') <= \Carbon\Carbon::now('Europe/Oslo')->format('H') 
                            and \Carbon\Carbon::parse ($booking->to)->format('H') > \Carbon\Carbon::now('Europe/Oslo')->format('H'))

                            <td class="px-6 py-2">
                                {{ $booking->user->given_name }}
                            </td>

                            <td class="px-6 py-2 font-bold">
                            @if($booking->checkin)
                                <span class="text-emerald-400">Sjekket inn</span>
                            @else
                                <span class="text-rose-600">Ikke tilstede</span>
                            @endif
                            </td>

                        @else
                            <td class="px-6 py-2 text-gray-300">Ledig </td>
                            <td class="px-6 py-2">
                            </td>
                        @endif
                        
                    @endforeach    
                @else
                    <td class="px-6 py-2 text-gray-300">Ledig </td>
                    <td class="px-6 py-2">
                    </td>
                    
                 @endif
               
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
