<div class='text-center text-light text-uppercase mt-30px' style="width: 224px; height: 160px; background-image: url({{ asset('images/office.jpeg') }}); background-size: cover; cursor: pointer; border-radius: 5%; border: none ">
    <a href="/room/{{ $id ?? '' }}" style='text-decoration: none;'>
    <div  style='width: 224px; height: 160px; background-image: -webkit-linear-gradient(top, rgb(31 25 61 / 70%), rgba(217 134 10 / 40%))'>
    <div style='font-size:16px; padding-top: 62px'>{{ $name }}</div>
    <div style='font-size:14px; padding-top: 10px; color:white; text-transform: lowercase;'> available: {{ $seatCount }} </div>
    </div>
    </a>
</div>
