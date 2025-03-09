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
    <title>Admin Panel - Users</title>
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
                <h3 class=" mb-4">Users</h3>
                <!-- GEneral Settings -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body ">

                        <div class="text-end mb-4">
                            <input type="text" oninput="search_user(this.value)" class="form-control shadow-none w-25 ms-auto"
                                placeholder="Type to search">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover border" style="min-width:1000px">
                                <thead class="sticky-top">
                                    <tr class="bg-light text-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone no.</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>


                                    </tr>
                                </thead>

                                <tbody id="users-data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php require('inc/scripts.php') ?>
    <script src="scripts/users.js"></script>


</body>

</html>