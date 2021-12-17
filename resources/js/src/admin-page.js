function showWindow(id, type, roomOrSeatName) {
    document.getElementsByClassName('popup-container')[0].className += ' active'
    document.getElementsByClassName('overlay')[0].className += ' active'
    document.getElementsByClassName('popup-title')[0].innerHTML = `Are you sure you want to delete ${roomOrSeatName.toUpperCase()}?`;
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
    document.getElementsByClassName('popup-container')[0].className += 'popup-container'
    document.getElementsByClassName('overlay')[0].className += 'overlay'
}

function addNewRoom() {
    document.getElementById('addNewRoom').style.display = 'block';
    let csrf_token = document.querySelector('[name="_token"]');
    let room_id = Math.random(100000);
    document.getElementById('addNewRoom').innerHTML += `<div class='text-center text-uppercase mt-30px room-container'>
           <div class="edit-box" style="pointer-events: all">
               <i class="far fa-trash-alt" onclick="showWindow(${room_id}, 'rooms', 'new room')"> </i> 

                <form id="newRoom" action=/room/store method="post">
                    <input class="edit-room-name" type="text" id="name" name="name" autocomplete="off" placeholder="Write room name">
                    <button class="submit-changes-btn" type="submit" value="submit">Save</button>
                </form>
            </div>
        </div> `;
    
    document.getElementById('newRoom').appendChild(csrf_token);
}

function addNewSeat(room_id) {
    document.getElementById('addNewSeat').style.display = 'block';
    let csrf_token = document.querySelector('[name="_token"]');
    let seat_types = document.querySelector('.edit-seat-type');
    let seat_id = Math.random(100000);
    document.getElementById('addNewSeat').innerHTML +=
        `<div class='text-center text-uppercase mt-30px room-container'>
           <div class="edit-box" style="pointer-events: all">
           <i class="far fa-trash-alt" onclick="showWindow(${seat_id}, 'seats', 'new seat')"> </i> 

              <form id=newSeat action=/seat/store method="post">
                   <select name=seat_type class="edit-seat-type text-dark"> 
                        ${seat_types.innerHTML}
                   </select>
                   <input name=room_id  value= ${room_id}
                      style="display:none;"> 
                    <input class="edit-seat-num" type="text" id="seat_number" autocomplete="off" placeholder="Write seat number" name="seat_number"> 
                    <button class="submit-changes-btn" type="submit" value="submit">Save</button>
               </form>
           </div>
        </div>`;
    document.getElementById('newSeat').appendChild(csrf_token);
}
