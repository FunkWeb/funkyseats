function showWindow(id, type) {
    document.getElementsByClassName('popup-container')[0].className += ' active'
    document.getElementsByClassName('overlay')[0].className += ' active'
    let room_delete = document.getElementById('confirm_delete');
    room_delete.setAttribute("action", "/" + type + "/" + id + "/delete");

    let seat_delete = document.getElementById('confirm_delete');
    seat_delete.setAttribute("action", "/" + type + "/" + id + "/delete");
}

function closeWindow() {
    document.getElementsByClassName('popup-container')[0].className += 'popup-container'
    document.getElementsByClassName('overlay')[0].className += 'overlay'
}

function addNewRoom() {
    document.getElementById('addNewRoom').style.display = 'block';
    let csrf_token = document.querySelector('[name="_token"]');
    document.getElementById('addNewRoom').innerHTML += '' +
        '<div class=\'text-center text-light text-uppercase mt-30px room-container\'\">\n' +
        '    <div class=\'edit-box\' style=\'pointer-events: all\'>\n' +
        '    <form id=newRoom action=/room/store method="post">' +
        '       <input class=\'edit-room-name\' type="text" id="name" name="name" placeholder="Room name">\n' +
        '       <button class=\'submit-changes-btn\' type=\'submit\' value=\'submit\'>Save</button>\n' +
        '    </form>' +
        '    </div>\n' +
        '</div>'
    document.getElementById('newRoom').appendChild(csrf_token);
}

function addNewSeat(room_id) {
    document.getElementById('addNewSeat').style.display = 'block';
    let csrf_token = document.querySelector('[name="_token"]');
    let seat_types = document.querySelector('.edit-seat-type');
    document.getElementById('addNewSeat').innerHTML =
        '<div class=\'text-center text-light text-uppercase mt-30px room-container\'>' +
        '    <div class=\'edit-box\' style=\'pointer-events: all\'>' +
        '<form id=newSeat action=/seat/store method="post">' +
        '<select name=seat_type class=\'edit-seat-type text-dark\'> ' +
        seat_types.innerHTML +
        '</select> '  +
        '            <input name=room_id value=' +
        room_id +
        ' style="display:none;">\n' +
        '            <input class=\'edit-seat-num\' type="text" id="seat_number" placeholder="Seat number" name="seat_number">\n' +
        '            <button class=\'submit-changes-btn\' type=\'submit\' value=\'submit\'>Save</button>' +
        '  </form>' +
        ' </div>' +
        '</div>'
    document.getElementById('newSeat').appendChild(csrf_token);
}
