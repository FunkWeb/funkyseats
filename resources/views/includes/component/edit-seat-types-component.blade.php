<div class="form-group seat_types_form">
    <form action=/admin/edit_seat_types/edit/{{ $id }} method="post">
    @csrf 
        <div class="row">
            <div class="col-3">
                <label for ="seat-type-name">Navn på setetype</label>
                <input type="text" class="form-control" id="seat-type-name" name="name" value="{{$name}}">
            </div>
                        
            <div class="col-8">    
                <label for="seat_description">Beskrivelse av setetype</label>
                <textarea class="form-control" id="seat_description" name="description" placeholder="Skriv setebeskrivelse">{{$description}}</textarea>
            </div>
            <div class="col">
                <div class="row plus_icon">
                        <a><i class="fas fa-plus" onclick="addNewSeatType()"></i></a>
                </div> 
                <div class="row trash_icon">  
                    <i class="far fa-trash-alt fa-lg" onclick="showWindow({{$id}}, 'types', '{{$name}}')"></i> 
                </div>
            </div>   
        </div>
                            
            <div class="row edit_seat_type_btns_row">
                    <button class='submit-changes-btn seat_type_btn' type='submit' value='submit'>Oppdater</button>
            </div> 
    </form>
</div> 