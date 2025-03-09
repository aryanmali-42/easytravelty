

function get_bookings(search = ' ', page = 1) {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/booking_records.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('table-data').innerHTML = this.responseText;
    };
    xhr.send('get_bookings&search=' + search + '&page=' + page);

}
function download(id) {
    window.location.href = 'generate_pdf.php?gen_pdf&id=' + id;
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