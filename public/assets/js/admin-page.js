function deleteRoom() {
    let classNameElement = document.getElementsByClassName('box-style');
    for (let i = 0; i < classNameElement.length; i++) {
       classNameElement[i].remove()
        break;
    }
}
