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

    <!-- PAckages  -->
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class=" mb-4">Packages</h3>
                <!-- GEneral Settings -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body ">

                        <div class="text-end mb-4">
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#add-package">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>
                        <div class="table-responsive-lg" style="height: 430px; overflow-y:scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-light text-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">No Of People</th>
                                        <th scope="col">Categories</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Major Travel Mode</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>

                                <tbody id="package-data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Add package modal -->
                <div class="modal fade" id="add-package" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form id="add_package_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Package </h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Name</label>
                                            <input type="text" name="name" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Duration </label>
                                            <input type="number" min="1" name="duration"
                                                class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Price</label>
                                            <input type="number" name="price" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Major Travel Mode</label>
                                            <select name="travel_mode" class="form-control shadow-none">
                                                <option value="flight">Flight</option>
                                                <option value="train">Train</option>
                                                <option value="bus">Bus</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Date</label>
                                            <input type="date" name="date" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">No of Seats/Packages</label>
                                            <input type="number" name="adult" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md-12 mb-3">

                                            <label class="form-label fw-bold">Category</label>
                                            <select name="category" class="form-control shadow-none">
                                                <option value="honeymoon">Honeymoon</option>
                                                <option value="adventure">Adventure</option>
                                                <option value="family">Family Trip</option>
                                                <option value="luxury">Luxury</option>
                                            </select>
                                        </div>
                                        <!-- FEATURES -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Features</label>
                                            <div class="row">
                                                <?php
                                                $res = selectAll('features');
                                                while ($opt = mysqli_fetch_assoc($res)) {
                                                    echo "
                                                        <div class='col-md-3 mb-1'>
                                                                <label>
                                                                    <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'/>
                                                                      $opt[name]
                                                                </label>
                                                            </div>
                                                        ";
                                                }
                                                ?>
                                            </div>

                                        </div>
                                        <!-- FACILITIES -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Facilities</label>
                                            <div class="row">
                                                <?php
                                                $res = selectAll('facilities');
                                                while ($opt = mysqli_fetch_assoc($res)) {
                                                    echo "
                                                        <div class='col-md-3 mb-1'>
                                                                <label>
                                                                    <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'/>
                                                                      $opt[name]
                                                                </label>
                                                            </div>
                                                        ";
                                                }
                                                ?>
                                            </div>

                                        </div>
                                        <!-- TEXTBOX -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Description</label>
                                            <textarea name="desc" rows="4" class="form-control shadow-none"
                                                required></textarea>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Iternity (New Line For Other Day)</label>
                                            <textarea name="iter" rows="4" class="form-control shadow-none"
                                                required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn text-secondary shadow-none"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn custombg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <!-- Edit Package Modal -->
                <div class="modal fade" id="edit-package" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form id="edit_package_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Package</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Name</label>
                                            <input type="text" name="name" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Duration</label>
                                            <input type="number" min="1" name="duration"
                                                class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Price</label>
                                            <input type="number" name="price" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Date</label>
                                            <input type="date" name="date" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Major Travel Mode</label>
                                            <select name="travel_mode" class="form-control shadow-none">
                                                <option value="flight">Flight</option>
                                                <option value="train">Train</option>
                                                <option value="bus">Bus</option>
                                            </select>

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">No of seats/Packages</label>
                                            <input type="number" name="adult" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md- mb-3">
                                            <label class="form-label fw-bold">Category</label>
                                            <select name="category" class="form-control shadow-none">
                                                <option value="honeymoon">Honeymoon</option>
                                                <option value="adventure">Adventure</option>
                                                <option value="family">Family Trip</option>
                                                <option value="luxury">Luxury</option>
                                            </select>

                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Features</label>
                                            <div class="row">
                                                <?php
                                                $res = selectAll('features');
                                                while ($opt = mysqli_fetch_assoc($res)) {
                                                    echo "
                                                        <div class='col-md-3 mb-1'>
                                                                <label>
                                                                    <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'/>
                                                                      $opt[name]
                                                                </label>
                                                            </div>
                                                        ";
                                                }
                                                ?>
                                            </div>

                                        </div>
                                        <!-- FACILITIES -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Facilities</label>
                                            <div class="row">
                                                <?php
                                                $res = selectAll('facilities');
                                                while ($opt = mysqli_fetch_assoc($res)) {
                                                    echo "
                                                        <div class='col-md-3 mb-1'>
                                                                <label>
                                                                    <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'/>
                                                                      $opt[name]
                                                                </label>
                                                            </div>
                                                        ";
                                                }
                                                ?>
                                            </div>

                                        </div>
                                        <!-- TEXTBOX -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Description</label>
                                            <textarea name="desc" rows="4" class="form-control shadow-none"
                                                required></textarea>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Iternity  (New Line For Other Day)</label>
                                            <textarea name="iter" rows="4" class="form-control shadow-none"
                                                required></textarea>
                                        </div>
                                        <!-- EDIT KARNA HAI -->
                                        <input type="text" name="package_id">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn text-secondary shadow-none"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn custombg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- MANAEGE ROOM IMAGE MODAL -->

                <div class="modal fade" id="package-images" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Package Name</h5>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="image-alert">

                                </div>
                                <div class="border-bottom border-3 pb-3 mb-3">
                                    <form id="add_image_form">
                                        <input type="file" name="image" accept=".jpg,.png,.webp,.jpeg"
                                            class="form-control shadow-none  mb-3" required>
                                        <button class="btn custombg text-white shadow-none">Add</button>
                                        <input type="hidden" name="package_id" />
                                    </form>
                                </div>
                                <div class="table-responsive-lg" style="height: 350px; overflow-y:scroll;">
                                    <table class="table table-hover border">
                                        <thead class="sticky-top">
                                            <tr class="bg-light text-dark sticky-top">
                                                <th scope="col" width="60%">Image</th>
                                                <th scope="col">Thumb</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>

                                        <tbody id="package-image-data">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



                <?php require('inc/scripts.php') ?>
                <script src="scripts/package.js"></script>


</body>

</html>