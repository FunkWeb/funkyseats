function changeCheck(button){
    if (button.children[1].textContent === 'Check In'){
         button.children[1].textContent = 'Check Out';
         button.className += ' checkedIn ';
    }

    else{
        button.children[1].textContent = 'Check In';
        button.className = 'check-in-btn';
    }
}      