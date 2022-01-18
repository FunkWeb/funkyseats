<div class='text-center text-light text-uppercase mt-30px'>
@if ($booking == '[]')
    <div class='available-seat seat-container'>
@elseif ( Auth::check() && (string)Auth::user()->id == $booker_id ?? '')
    <div class='booked-by-me seat-container'>
@else
    <div class='booked-seat seat-container'>
@endif
         <div class='seat-type-btn'>{{ $type ?? '' }}</div>
         <div class='seat-num'><b>Seat {{ $seat_number ?? '' }}</b></div>
  @if ($booking != '[]' && Auth::check())
     @if (\Carbon\Carbon::parse($booked_from)->format('H') == 8 && \Carbon\Carbon::parse($booked_to)->format('H') == 16)
         <div class="user-booking-info user-name-booked-seat">
             <div class="d-flex flex-row">
                 <div class="mr-6px"><img src="{{ $user_picture?? '' }}" class="user-picture-booked-seat"></div>
                 <div class="mx-6px my-auto">{{ $user_name }}</div>
             </div>
             <div>{{ 'All day' }}</div>
         </div>
     @elseif (\Carbon\Carbon::parse($booked_from)->format('H') == 8)
         <div class="user-booking-info user-name-booked-seat">
             <div><img src="{{ $user_picture ?? '' }}" class="user-picture-booked-seat"></div>
             <div>
                 <div> {{ $user_name }}</div>
                 <div>{{ 'Before lunch' }}</div>
             </div>
         </div>
     @elseif(\Carbon\Carbon::parse($booked_to)->format('H') == 16)
         <div class="user-booking-info user-name-booked-seat">
             <div><img src="{{ $user_picture ?? '' }}" class="user-picture-booked-seat"></div>
             <div>
                 <div> {{ $user_name }}</div>
                 <div>{{ 'After lunch' }}</div>
             </div>
         </div>
     @endif
  @endif
    </div>
</div>
