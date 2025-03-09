

function get_bookings(search = ' ') {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/new_bookings.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('table-data').innerHTML = this.responseText;
    };
    xhr.send('get_bookings&search=' + search);

}
function cancel_booking(id) {
    if (confirm("Are You Sure , You Want To Cancel This Booking?")) {
        let data = new FormData(); //interface to snd file png
        data.append('booking_id', id);
        data.append('cancel_booking', '');
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/new_bookings.php", true);
        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success', 'Booking Cancelled ');
                get_bookings();
            }
            else {
                alert('error', 'serverdown');
            }

        }
        xhr.send(data);
    }


}


// function search_user(username) {
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "ajax/users.php", true);
//     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

//     xhr.onload = function () {
//         document.getElementById('users-data').innerHTML = this.responseText;
//     };
//     xhr.send('search_users&name=' + username);
// }
window.onload = function () {
    get_bookings();
}