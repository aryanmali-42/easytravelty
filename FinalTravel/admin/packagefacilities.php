<?php
require('inc/essentials.php');
require('../connection.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Packages</title>
    <?php
    require('inc/links.php');
    ?>

    <style>

    </style>
</head>

<body>
    <?php require('inc/header.php') ?>
    <!-- FACILITy -->
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class=" m-4">Facilities</h3>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body ">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3 class="card-title m-0"></h3>
                            <type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#facility-s">
                                <i class="bi bi-plus-square"></i> Add
                                </button>
                        </div>
                        <div class="table-responsive-md" style="height: 450px; overflow-y:scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-light text-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" width="40%">Decription</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="facilities-data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facility Model -->
    <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="facility_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Facility </h5>

                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="facility_name" class="form-control shadow-none " required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Icon(.svg)</label>
                            <input type="file" name="facility_icon" accept=".svg"
                                class="form-control shadow-none  shadow-none" required>
                        </div>
                        <div class="col-md-12 p-0 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="facility_desc" class="form-control shadow-none" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none"
                            data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn custombg text-dark shadow-none">SUBMIT</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- facility_s_form script -->
    <script>
        let facility_s_form = document.getElementById('facility_s_form');
        facility_s_form.addEventListener('submit', function (e) {
            e.preventDefault(); //default behivaur submit page of form
            add_facility();
        });
        function add_facility() {
            let data = new FormData(); //interface to snd file png
            data.append('name', facility_s_form.elements['facility_name'].value);
            data.append('icon', facility_s_form.elements['facility_icon'].files[0]); //1st image only
            data.append('desc', facility_s_form.elements['facility_desc'].value); 


            data.append('add_facility', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features.php", true);
            xhr.onload = function () {
                console.log(this.responseText);
                var myModal = document.getElementById('facility-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();
                if (this.responseText == 'inv_img') {
                    alert('error', 'Only Svg images are allowed!');
                }
                else if (this.responseText == 'inv_size') {
                    alert('error', 'Image Should be less than 1mb');
                }
                else if (this.responseText == 'upd_failed') {
                    alert('error', 'Failed to Upload image Server Down');
                }
                else {
                    alert('success', 'New Facility Added');
                    facility_s_form.reset();
                    get_facilities();
                }

            }
            xhr.send(data);
        }
        function get_facilities() {

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                document.getElementById('facilities-data').innerHTML = this.responseText;
            }
            xhr.send('get_facilities');
        }

        function rem_facilities(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (this.responseText == 1) {
                    alert('error', ' Server Down');
                }
                else if (this.responseText == 'package_added') {
                    alert('error', ' Facility is added in package');
                }
                else {
                    alert('success', 'Facility Removed');
                    get_facilities();
                }
            }
            xhr.send('rem_facilities=' + val);

        }

        window.onload = function () {
            get_facilities();
        }
    </script>

    <?php require('inc/scripts.php') ?>

</body>

</html>