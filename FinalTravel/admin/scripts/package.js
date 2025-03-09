let add_package_form = document.getElementById('add_package_form');
add_package_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_package();
});

function add_package() {
    let data = new FormData(); // Interface to send file png
    data.append('add_package', '');
    data.append('name', add_package_form.elements['name'].value);
    data.append('duration', add_package_form.elements['duration'].value);
    data.append('price', add_package_form.elements['price'].value);
    data.append('travel_mode', add_package_form.elements['travel_mode'].value);
    data.append('date', add_package_form.elements['date'].value);
    data.append('adult', add_package_form.elements['adult'].value);
    data.append('category', add_package_form.elements['category'].value);
    data.append('desc', add_package_form.elements['desc'].value);
    data.append('iter', add_package_form.elements['iter'].value);

    // Handle features
    let features = [];
    let featureElements = add_package_form.elements['features'];

    if (featureElements) {
        if (featureElements.length === undefined) {
            // Single checkbox case
            if (featureElements.checked) {
                features.push(featureElements.value);
            }
        } else {
            // Multiple checkboxes
            Array.from(featureElements).forEach(el => {
                if (el.checked) {
                    features.push(el.value);
                }
            });
        }
    }

    // Handle facilities
    let facilities = [];
    let facilityElements = add_package_form.elements['facilities'];

    if (facilityElements) {
        if (facilityElements.length === undefined) {
            // Single checkbox case
            if (facilityElements.checked) {
                facilities.push(facilityElements.value);
            }
        } else {
            // Multiple checkboxes
            Array.from(facilityElements).forEach(el => {
                if (el.checked) {
                    facilities.push(el.value);
                }
            });
        }
    }

    data.append('features', JSON.stringify(features));
    data.append('facilities', JSON.stringify(facilities));

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/package.php", true);
    xhr.onload = function () {
        console.log(this.responseText);
        var myModal = document.getElementById('add-package');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'New Package Added');
            add_package_form.reset();
        } else {
            alert('error', 'Server Down');

        }
        get_all_packages();
    };
    xhr.send(data);


}

function get_all_packages() {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/package.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('package-data').innerHTML = this.responseText;
    };
    xhr.send('get_all_packages');

}

let edit_package_form = document.getElementById('edit_package_form');

function edit_details(id) {
    console.log(id);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/package.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {

        let data = JSON.parse(this.responseText); //yaha data text hota hai number me convert crow
        edit_package_form.elements['name'].value = data.packagedata.name;
        edit_package_form.elements['duration'].value = data.packagedata.duration;
        edit_package_form.elements['price'].value = data.packagedata.price;
        edit_package_form.elements['travel_mode'].value = data.packagedata.travel_mode;
        edit_package_form.elements['date'].value = data.packagedata.date;
        edit_package_form.elements['adult'].value = data.packagedata.adult;
        edit_package_form.elements['category'].value = data.packagedata.category;
        edit_package_form.elements['desc'].value = data.packagedata.description;
        edit_package_form.elements['iter'].value = data.packagedata.iternity;
        edit_package_form.elements['package_id'].value = data.packagedata.id;
        edit_package_form.elements['features'].forEach(el => {
            if (data.features.includes(Number(el.value))) {
                el.checked = true;
            }
        });
        edit_package_form.elements['facilities'].forEach(el => {
            if (data.facilities.includes(Number(el.value))) {
                el.checked = true;
            }
        });
    };
    xhr.send('get_package=' + id);

}

function toggleStatus(id, val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/package.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'Status Up');


        }
        else {

            alert('error', 'Server Down');
        }
        get_all_packages();
    };
    xhr.send('toggleStatus=' + id + '&value=' + val);

}
edit_package_form.addEventListener('submit', function (e) {
    e.preventDefault();
    submit_edit_package();
});

function submit_edit_package() {
    let data = new FormData(); // Interface to send file png
    data.append('edit_package', '');
    data.append('package_id', edit_package_form.elements['package_id'].value);
    data.append('name', edit_package_form.elements['name'].value);
    data.append('duration', edit_package_form.elements['duration'].value);
    data.append('price', edit_package_form.elements['price'].value);
    data.append('travel_mode', edit_package_form.elements['travel_mode'].value);
    data.append('date', edit_package_form.elements['date'].value);
    data.append('adult', edit_package_form.elements['adult'].value);
    data.append('category', edit_package_form.elements['category'].value);
    data.append('desc', edit_package_form.elements['desc'].value);
    data.append('iter', edit_package_form.elements['iter'].value);

    // Handle features
    let features = [];
    let featureElements = edit_package_form.elements['features'];

    if (featureElements) {
        if (featureElements.length === undefined) {
            // Single checkbox case
            if (featureElements.checked) {
                features.push(featureElements.value);
            }
        } else {
            // Multiple checkboxes
            Array.from(featureElements).forEach(el => {
                if (el.checked) {
                    features.push(el.value);
                }
            });
        }
    }

    // Handle facilities
    let facilities = [];
    let facilityElements = edit_package_form.elements['facilities'];

    if (facilityElements) {
        if (facilityElements.length === undefined) {
            // Single checkbox case
            if (facilityElements.checked) {
                facilities.push(facilityElements.value);
            }
        } else {
            // Multiple checkboxes
            Array.from(facilityElements).forEach(el => {
                if (el.checked) {
                    facilities.push(el.value);
                }
            });
        }
    }

    // Convert features and facilities to JSON format
    data.append('features', JSON.stringify(features));
    data.append('facilities', JSON.stringify(facilities));

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/package.php", true);
    xhr.onload = function () {
        console.log(this.responseText);

        // Handle the modal after server response
        var myModal = document.getElementById('edit-package');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'Package Data Edited Successfully');
            edit_package_form.reset();
        } else if (this.responseText == 'fk_error') {
            alert('error', 'Foreign Key Constraint Violation: Ensure valid Features and Facilities are selected');
        } else {
            alert('error', 'Server Down. Please Try Again');
        }
        get_all_packages()

    };
    xhr.send(data);
}

let add_image_form = document.getElementById('add_image_form');
add_image_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_image();
});

function add_image() {
    let data = new FormData(); //interface to snd file png
    data.append('image', add_image_form.elements['image'].files[0]); //single img
    data.append('package_id', add_image_form.elements['package_id'].value); //single img
    data.append('add_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/package.php", true);
    xhr.onload = function () {
        if (this.responseText == 'inv_img') {
            alert('error', 'Only JPG ,WebP or  PNG images are allowed', 'image-alert');
        }
        else if (this.responseText == 'inv_size') {
            alert('error', 'Image size should be less than 2MB', 'image-alert');
        }
        else if (this.responseText == 'upd_failed') {
            alert('error', 'Failed to update member details Server Down', 'image-alert');
        }
        else {
            alert('success', 'Image Added', 'image-alert');
            package_images(add_image_form.elements['package_id'].value, document.querySelector("#package-images .modal-title").innerText);
            add_image_form.reset();
        }

    }
    xhr.send(data);
}

function package_images(id, pname) {
    document.querySelector("#package-images .modal-title").innerText = pname;
    add_image_form.elements['package_id'].value = id;
    add_image_form.elements['image'].value = '';
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/package.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('package-image-data').innerHTML = this.responseText;
    };
    xhr.send('get_package_images=' + id);

}

function rem_image(img_id, package_id) {
    let data = new FormData(); //interface to snd file png
    data.append('image_id', img_id); //single img
    data.append('package_id', package_id); //single img
    data.append('rem_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/package.php", true);
    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'Image Removed', 'image-alert');
            package_images(package_id, document.querySelector("#package-images .modal-title").innerText);

        }
        else {
            alert('error', 'iMAGE rEMOVAL FAILED', 'image-alert');

        }

    }
    xhr.send(data);
}

function thumb_image(img_id, package_id) {
    let data = new FormData(); //interface to snd file png
    data.append('image_id', img_id); // 
    data.append('package_id', package_id); //s
    data.append('thumb_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/package.php", true);
    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'Image ThumbNaill Changed', 'image-alert');
            package_images(package_id, document.querySelector("#package-images .modal-title").innerText);

        }
        else {
            alert('error', 'Thumbnaill rEMOVAL FAILED', 'image-alert');

        }

    }
    xhr.send(data);
}

function remove_package(package_id) {
    if (confirm("Are You Sure , You Want To Delete This Package?")) {
        let data = new FormData(); //interface to snd file png
        data.append('package_id', package_id); //single img
        data.append('remove_package', '');
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/package.php", true);
        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success', 'Package Removed');
                get_all_packages();
            }
            else {
                alert('error', 'PACKAGE REMOVAL FAILED');

            }

        }
        xhr.send(data);
    }


}



window.onload = function () {
    get_all_packages();
}