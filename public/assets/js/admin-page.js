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
    document.getElementById('addNewRoom').innerHTML = '' +
        '<div class=\'text-center text-light text-uppercase mt-30px box-style\'\n' +
        '    style=\"background-image: url(\'../images/office.jpeg\')\">\n' +
        '    <div class=\'edit-box\' style=\'pointer-events: all\'>\n' +
        '        <input class=\'edit-room-name\' type="text" id="name" name="name" placeholder="Room name">\n' +
        '       <button class=\'submit-changes-btn\' type=\'submit\' value=\'submit\'>Save</button>\n' +
        '    </div>\n' +
        '</div>'
}

function addNewSeat() {
    document.getElementById('addNewSeat').style.display = 'block';
    document.getElementById('addNewSeat').innerHTML = '' +
        '<div class=\'text-center text-light text-uppercase mt-30px box-style\'\n' +
        '    style=\"background-image: url(\'/images/office.jpeg\')\">\n' +
        '    <div class=\'edit-box\' style=\'pointer-events: all\'>\n' +
        '<form action=/seats/{{ $seat_id ?? \'\' }}/save/ method="post">\n' +
        '            @csrf\n' +
        '            <select name="seat_type" class=\'edit-seat-type\'>\n' +
        '                {{ $seat_types_list }}\n' +
        '            </select>\n' +
        '            <br>\n' +
        '             <input class=\'edit-seat-num\' type="text" id="seat_number" placeholder="Seat number" name="seat_number">\n' +
        '            <button class=\'submit-changes-btn\' type=\'submit\' value=\'submit\'>Save</button>\n' +
        '        </form>\n' +
        '    </div>\n' +
        '</div>'
}
