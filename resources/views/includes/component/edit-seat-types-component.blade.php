<div class="form-group seat_types_form">
    <form action=/admin/edit_seat_types/edit/{{ $id }} method="post">
    @csrf 
        <div class="row trash_icon">
            <div class="col plus_icon">
                <a><i class="fas fa-plus" onclick="addNewSeatType()"></i></a>
            </div> 
            <div class="col">
                <i class="far fa-trash-alt fa-lg" onclick="showWindow({{$id}}, 'types', '{{$name}}')"></i>
            </div>
            
        </div>
        <div class="row">
            <div class="col-4">
                <label for ="seat-type-name">Seat-name</label>
                <input type="text" class="form-control" id="seat-type-name" name="name" value="{{$name}}">
            </div>
                        
            <div class="col">    
                <label for="seat_description">Seat description</label>
                <textarea class="form-control" id="seat_description" name="description" placeholder="Write seat description">{{$description}}</textarea>
            </div>  
        </div>
                            
            <div class="row edit_seat_type_btns_row">
                    <button class='submit-changes-btn seat_type_btn' type='submit' value='submit'>Update</button>
            </div> 
    </form>
</div> 