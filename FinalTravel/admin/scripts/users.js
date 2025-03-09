

function get_users() {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('users-data').innerHTML = this.responseText;
    };
    xhr.send('get_users');

}
function toggleStatus(id, val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'Status Up');

            get_users();

        }
        else {

            alert('error', 'Server Down');
        }
    };
    xhr.send('toggleStatus=' + id + '&value=' + val);

}
// edit_package_form.addEventListener('submit', function (e) {
//     e.preventDefault();
//     submit_edit_room();
// });
function remove_user(user_id) {
    if (confirm("Are You Sure , You Want To Remove This User?")) {
        let data = new FormData(); //interface to snd file png
        data.append('user_id', user_id);
        data.append('remove_users', '');
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/users.php", true);
        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success', 'User Removed');
                get_users();
            }
            else {
                alert('error', 'USER REMOVAL FAILED');

            }

        }
        xhr.send(data);
    }


}

function search_user(username) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        document.getElementById('users-data').innerHTML = this.responseText;
    };
    xhr.send('search_users&name=' + username);
}
window.onload = function () {
    get_users();
}