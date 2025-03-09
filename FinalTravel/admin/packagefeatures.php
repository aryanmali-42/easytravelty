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
<?php require('inc/header.php') ?>

<body>


    <div class="container-fluid " id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class=" m-4">Features</h3>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body ">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3 class="card-title m-0"></h3>
                            <type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#features-s">
                                <i class="bi bi-plus-square"></i> Add
                                </button>
                        </div>
                        <div class="table-responsive-md" style="height: 450px; overflow-y:scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-light text-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="features-data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features Model -->
    <div class="modal fade" id="features-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="features_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Feature </h5>

                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="features_name" class="form-control shadow-none " required>
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


    <!-- Features script -->
    <script>
        let features_s_form = document.getElementById('features_s_form');
        features_s_form.addEventListener('submit', function (e) {
            e.preventDefault(); //default behivaur submit page of form matlab scro;;; etc se prblm nahib hoga
            add_features();
        });
        function add_features() {
            let data = new FormData(); //interface to snd file png
            data.append('name', features_s_form.elements['features_name'].value);
            data.append('add_features', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features.php", true);
            xhr.onload = function () {
                console.log(this.responseText);
                var myModal = document.getElementById('features-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();
                if (this.responseText == 1) {
                    alert('success', 'New Feature Added');
                    features_s_form.elements['features_name'].value = '';
                    get_features();
                }
                else {
                    alert('error', 'Server Down');

                }

            }
            xhr.send(data);
        }
        function get_features() {

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                document.getElementById('features-data').innerHTML = this.responseText;
            }
            xhr.send('get_features');
        }
        function rem_features(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (this.responseText == 1) {
                    alert('error', ' Server Down');
                }
                else if (this.responseText == 'package_added') {
                    alert('error', ' Feature is added in package');
                }
                else {
                    alert('success', 'Feature Removed');
                    get_features();
                }
            }
            xhr.send('rem_features=' + val);

        }

        window.onload = function () {
            get_features();
        }
    </script>

    <?php require('inc/scripts.php') ?>

</body>

</html>