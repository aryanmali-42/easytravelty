

function booking_statistics(period = 1) {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/dashboard.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        let data = JSON.parse(this.responseText);
        document.getElementById('total_bookings').textContent = data.total_bookings;
        document.getElementById('total_amt').textContent = '₹' + data.total_amt;
        document.getElementById('active_bookings').textContent = data.active_bookings;
        document.getElementById('active_amt').textContent = '₹' + data.active_amt;
        document.getElementById('cancelled_bookings').textContent = data.cancelled_bookings;
        document.getElementById('cancelled_amt').textContent = '₹' + data.cancelled_amt;
    }
    xhr.send('booking_statistics&period=' + period);

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
    booking_statistics();
}