function showWindow(id, type, roomOrSeatName) {
    let popUpWindow = document.getElementsByClassName('popup-container');
    let csrf_token = document.querySelector('[name="_token"]');
    popUpWindow[0].className += ' active';
    document.getElementsByClassName('overlay')[0].className += ' active';
    popUpWindow[0].innerHTML += 
        `<div class="popup-header">
            <div class="popup-title"> Are you sure you want to delete ${roomOrSeatName.toUpperCase()}? </div>
        </div>

        <div class="popup-btn">
            <button onclick="closeWindow()">Cancel</button>
            <form id="confirm_delete" method="post">
                <button type='submit' value='submit'>Yes</button>
            </form>
        </div>`;

    document.getElementById('confirm_delete').appendChild(csrf_token);

        if (type === 'rooms'){
            let room_delete = document.getElementById('confirm_delete');
            room_delete.setAttribute("action", "/" + type + "/" + id + "/delete");
        }
         
        else if (type === 'seats'){
            let seat_delete = document.getElementById('confirm_delete');
            seat_delete.setAttribute("action", "/" + type + "/" + id + "/delete");
        }        
    
}

function closeWindow() {
    let popUpWindow = document.getElementsByClassName('popup-container');
    popUpWindow[0].className = 'popup-container';
    document.getElementsByClassName('overlay')[0].className = 'overlay';
    popUpWindow[0].innerHTML = ``;

}

function addNewRoom() {
    document.getElementById('addNewRoom').style.display = 'block';
    let csrf_token = document.querySelector('[name="_token"]');
    let room_id = Math.random(100000) * -1;
    document.getElementById('addNewRoom').innerHTML += 
        `<div class='text-center text-uppercase mt-30px room-container'>
           <div class="edit-box" style="pointer-events: all">
               <i class="far fa-trash-alt fa-lg" onclick="showWindow(${room_id}, 'rooms', 'new room')"> </i> 

                <form id="newRoom" action=/room/store method="post">
                    <input class="edit-room-name" type="text" id="name" name="name" autocomplete="off" autofocus placeholder="Write room name">
                    <button class="submit-changes-btn" type="submit" value="submit">Save</button>
                </form>
            </div>
        </div> `;

    let new_room = document.getElementById('newRoom');
    new_room.appendChild(csrf_token);
    new_room.focus();
    new_room.scrollIntoView();
}

function addNewSeat(room_id) {
    document.getElementById('addNewSeat').style.display = 'block';
    let csrf_token = document.querySelector('[name="_token"]');
    let seat_types = document.querySelector('.edit-seat-type');
    let seat_id = Math.random(100000) * -1;
    document.getElementById('addNewSeat').innerHTML +=
        `<div class='text-center text-uppercase mt-30px room-container newseat'>
           <div class="edit-box" style="pointer-events: all">
           <i class="far fa-trash-alt fa-lg" onclick="showWindow(${seat_id}, 'seats', 'new seat')"> </i> 

              <form id=newSeat action=/seat/store method="post">
                   <select name=seat_type class="edit-seat-type"> 
                        ${seat_types.innerHTML}
                   </select>
                   <input name=room_id  value= ${room_id}
                      style="display:none;"> 
                    <input class="edit-seat-num" type="text" id="seat_number" autocomplete="off" placeholder="Write seat number" autofocus name="seat_number"> 
                    <button class="submit-changes-btn" type="submit" value="submit">Save</button>
               </form>
           </div>
        </div>`;
    let new_seat = document.getElementById('newSeat');
    new_seat.appendChild(csrf_token);
    new_seat.focus();
    new_seat.scrollIntoView();
}

function toggleActive(buttonSelect){
    var buttons = document.getElementsByClassName("stats-button");
    for (let i=0; i < buttons.length; i++){
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        buttonSelect.className+= " active"
    }   

}

