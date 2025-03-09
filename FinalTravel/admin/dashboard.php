<?php
require('inc/essentials.php');
require('../connection.php');

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <?php require('inc/links.php'); ?>
    <style>
        .custom-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            border-radius: 15px;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 600;
        }

        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .section-title {
            color: #2c3e50;
            border-left: 4px solid #3498db;
            padding-left: 1rem;
            margin: 2rem 0;
        }
    </style>
</head>

<body class="bg-light">
    <?php
    require('inc/header.php');

    $is_shutdown = mysqli_fetch_assoc(mysqli_query($con, "SELECT `shutdown` FROM `settings`"));
    // single row hoti mahnun asa use kele
    $current_bookings = mysqli_fetch_assoc(mysqli_query($con, "SELECT 
    COUNT(CASE WHEN booking_status='booked' THEN 1 END) AS `new_bookings`,
    COUNT(CASE WHEN booking_status='cancelled' AND refund=0 THEN 1 END) AS `refund_bookings`
    FROM `orders`")); // yaha hume count krna hai , case madhe when keyword use krtot its an condition id else true or false
    
    $unread_queries = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(sr_no) AS `count`
     FROM `user_queries` WHERE `seen`=0"));
    $current_users = mysqli_fetch_assoc(mysqli_query($con, "SELECT 
    COUNT(id) AS `total`,
    COUNT(CASE WHEN `status`=1 THEN 1 END) AS `active`,
    COUNT(CASE WHEN `status`=0 THEN 1 END) AS `inactive` 
    FROM `user_cred`"));
    $user_reviews = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(sr_no) AS `count` FROM `rating_review` WHERE `seen`=0"));




    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-3 p-md-4 overflow-hidden">
                <!-- Changed p-4 to p-3 p-md-4 for better mobile padding -->
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3 class="fw-bold text-primary">Dashboard Overview</h3>
                    <?php if ($is_shutdown['shutdown']): ?>
                        <div class="alert alert-danger d-flex align-items-center py-2 mb-0" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <div>Shutdown Mode Active!</div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Quick Stats Row -->
                <div class="row g-4 mb-4">
                    <div class="col-6 col-md-3">
                        <!-- Changed to col-6 for mobile (2 columns) -->
                        <a href="newbookings.php" class="text-decoration-none">
                            <div class="custom-card card bg-success text-white p-4">
                                <div class="card-icon"><i class="bi bi-calendar-check"></i></div>
                                <h5 class="mb-3">New Bookings</h5>
                                <div class="stat-number"><?php echo $current_bookings['new_bookings'] ?></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="refundbookings.php" class="text-decoration-none">
                            <div class="custom-card card bg-warning text-dark p-4">
                                <div class="card-icon"><i class="bi bi-arrow-counterclockwise"></i></div>
                                <h5 class="mb-3">Refund Bookings</h5>
                                <div class="stat-number"><?php echo $current_bookings['refund_bookings'] ?></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="user_question.php" class="text-decoration-none">
                            <div class="custom-card card bg-info text-white p-4">
                                <div class="card-icon"><i class="bi bi-question-circle"></i></div>
                                <h5 class="mb-3">User Queries</h5>
                                <div class="stat-number"><?php echo $unread_queries['count'] ?></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="rate_review.php" class="text-decoration-none">
                            <div class="custom-card card bg-info text-white p-4">
                                <div class="card-icon"><i class="bi bi-question-circle"></i></div>
                                <h5 class="mb-3">User Ratings</h5>
                                <div class="stat-number"><?php echo $user_reviews['count'] ?></div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="custom-card bg-white align-items-centre p-4 rounded-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="section-title">Booking Statistics</h4>
                        <select class="form-select w-auto" aria-label="Default select example"
                            onchange="booking_statistics(this.value)">
                            <option value="1">Past 30 Days </option>
                            <option value="2">Past 90 Days</option>
                            <option value="3">All Time </option>
                        </select>
                    </div>
                    <br>
                    <div class="row g-4">
                        <div class="col-12 col-md-4">
                            <a href="bookingrecords.php" class="text-decoration-none">
                                <div class="custom-card card bg-primary text-white p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Total Bookings</h6>
                                            <h1 class="stat-number" id="total_bookings"></h1>
                                            <h4 class="" id="total_amt"></h4>

                                        </div>
                                        <i class="bi bi-people card-icon"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="newbookings.php" class="text-decoration-none">
                                <div class="custom-card card bg-success text-white p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Active Bookings </h6>
                                            <h1 class="stat-number" id="active_bookings"></h1>
                                            <h4 class="mt-2 mb-0" id="active_amt">₹</h4>
                                        </div>
                                        <i class="bi bi-person-check card-icon"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="bookingrecords.php" class="text-decoration-none">
                                <div class="custom-card card bg-danger text-white p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Cancelled Bookings</h6>
                                            <h1 class="stat-number" id="cancelled_bookings"></h1>
                                            <h4 class="mt-2 mb-0" id="cancelled_amt">₹</h4>
                                        </div>
                                        <i class="bi bi-person-x card-icon"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>


                <!-- User Statistics Section -->
                <div class="custom-card bg-white align-items-centre p-4 rounded-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="section-title">User Statistics</h4>

                    </div>
                    <br>
                    <div class="row g-4">
                        <div class="col-12 col-md-4">
                            <a href="users.php" class="text-decoration-none">
                                <div class="custom-card card bg-primary text-white p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Total Users</h6>
                                            <h1 class="stat-number"><?php echo $current_users['total'] ?></h1>
                                        </div>
                                        <i class="bi bi-people card-icon"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="users.php" class="text-decoration-none">
                                <div class="custom-card card bg-success text-white p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Active Users</h6>
                                            <h1 class="stat-number"><?php echo $current_users['active'] ?></h1>
                                        </div>
                                        <i class="bi bi-person-check card-icon"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="users.php" class="text-decoration-none">
                                <div class="custom-card card bg-danger text-white p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Inactive Users</h6>
                                            <h1 class="stat-number"><?php echo $current_users['inactive'] ?></h1>
                                        </div>
                                        <i class="bi bi-person-x card-icon"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?>
    <script src="scripts/dashboard.js"></script>
</body>

</html>