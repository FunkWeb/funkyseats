function deleteRoom() {
    document.getElementsByClassName('box-style')[0].remove()
    closeWindow()
}

function deleteSeat() {
    document.getElementsByClassName('admin-seat-bg-color')[0].remove()
    closeWindow()
}

function showWindow() {
    document.getElementsByClassName('popup-container')[0].className += ' active'
    document.getElementsByClassName('overlay')[0].className += ' active'
}

function closeWindow() {
    document.getElementsByClassName('popup-container')[0].className += 'popup-container'
    document.getElementsByClassName('overlay')[0].className += 'overlay'
}
