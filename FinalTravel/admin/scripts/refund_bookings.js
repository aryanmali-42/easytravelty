

function get_bookings(search = ' ') {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/refund_bookings.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('table-data').innerHTML = this.responseText;
    };
    xhr.send('get_bookings&search=' + search);

}
function refund_booking(id) {
    if (confirm("Refund Money For This Booking?")) {
        let data = new FormData(); //interface to snd file png
        data.append('booking_id', id);
        data.append('refund_booking', '');
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/refund_bookings.php", true);
        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success', 'Money Refunded! ');
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