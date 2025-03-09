<?php
error_reporting(0);
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('inc/header.php'); ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">

    <!-- Bootstrap CSS -->
    <?php require('inc/links.php') ?>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }

        .h-line {
            width: 150px;
            height: 2px;
            background-color: #2c3e50;
            margin: 10px auto 30px;
        }

        .search-container {
            max-width: 600px;
            margin: 30px auto 40px;
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .hover-scale:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            border-bottom: 3px solid #007bff;
        }


        .package-titlename {
            color: #2c3e50;
            font-size: 2.4rem !important;
            letter-spacing: -0.5px;
        }

        .text-primary {
            color: #007bff !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            font-weight: 500;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #f9ab30;
        }

        .btn-outline-dark {
            font-weight: 500;
        }


        .accordion-button {
            background-color: rgba(0, 123, 255, 0.05);
            font-weight: 500;
            color: #2c3e50;
            border-radius: 8px !important;
        }

        .accordion-button:not(.collapsed) {
            background-color: rgba(0, 123, 255, 0.1);
            color: #2c3e50;
            box-shadow: none;
        }

        .package-details .rounded {
            background-color: rgba(0, 123, 255, 0.05) !important;
            border: 1px solid rgba(0, 123, 255, 0.15) !important;
            transition: all 0.3s ease;
        }

        .package-details .rounded:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: #f9ab30;
            border-color: #007bff;
            padding: 12px 20px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .package-price {
            color: #2c3e50;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .search-container {
            max-width: 500px;
            margin: 20px auto;
        }

        .search-box {
            width: 100%;
            padding: 12px 20px;
            border-radius: 30px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .search-box:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }

        .accordion-button {
            background-color: rgba(0, 123, 255, 0.05);
            font-weight: 500;
            color: #2c3e50;
            border-radius: 8px !important;
            font-size: 15px;
        }

        .accordion-button:not(.collapsed) {
            background-color: rgba(0, 123, 255, 0.1);
            font-size: 15px;
            color: #2c3e50;
            box-shadow: none;
        }
    </style>
</head>

<body class="bg-light">

    <br><br><br>
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR PACKAGES</h2>
        <div class="h-line"></div>
    </div>
    <div class="search-container">
        <input type="text" id="searchInput" class="search-box" placeholder="Search packages..."
            onkeyup="filterPackages()">
    </div>
    <div class="container">
            <div class="row">
            <?php
            $package_res = select("SELECT * FROM `packages` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC", [1, 0], 'ii');
            while ($package_data = mysqli_fetch_assoc($package_res)) {
                // Get the current date
                $current_date = date('Y-m-d'); // Format to match your database date format
            
                // Check if the current date is greater than or equal to the start date
                if ($current_date >= $package_data['date']) {
                    // Skip the package if the tour has already started
                    continue;
                }

                // Get features from room 
                // Inner join usage
                $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `package_features` pfea ON f.id = pfea.features_id WHERE pfea.package_id='$package_data[id]'");
                $features_data = "";
                while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                    $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                 $fea_row[name]
                                </span>";
                }

                // Get facilities from room
                $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f INNER JOIN `package_facilities` pfac ON f.id=pfac.facilities_id WHERE pfac.package_id='$package_data[id]'");
                $facilities_data = "";

                while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                    $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                 $fac_row[name]
                                </span>";
                }

                // Get thumbnail
                $package_thumb = PACKAGE_IMG_PATH . "thumbnail.jpg";
                $thumb_q = mysqli_query($con, "SELECT * FROM `package_image` WHERE `package_id`='$package_data[id]' AND `thumb` ='1'");
                if (mysqli_num_rows($thumb_q) > 0) {
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $package_thumb = PACKAGE_IMG_PATH . $thumb_res['image'];
                }

                // Book button
                $book_btn = "";

                // Check if the website is not shut down
                if (!$settings_r['shutdown']) {
                    $login = 0;
                    if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                        $login = 1;
                    }

                    if ($login == 1) {
                        // If logged in, redirect to package details page
                        $book_btn = "<div class='d-grid gap-2'>
                                <a href='package_details.php?id=$package_data[id]' class='btn btn-primary btn-lg shadow-none'>
                                    <i class='fas fa-shopping-cart me-2'></i>More Details
                                </a>
                             </div>";
                    } else {
                        // If not logged in, show a button that triggers an alert
                        $book_btn = "<div class='d-grid gap-2'>
                                <button onclick='showLoginAlert()' class='btn btn-primary btn-lg shadow-none'>
                                    <i class='fas fa-shopping-cart me-2'></i>More Details
                                </button>
                             </div>";
                    }
                }

                // Print room card
                $start_date = $package_data['date']; // Start date from your database
                $duration = $package_data['duration']; // Duration in days from the database
            
                // Convert start date to a timestamp
                $start_timestamp = strtotime($start_date);

                // Add duration (in days) to the start date
                $end_timestamp = strtotime("+$duration days", $start_timestamp);

                // Convert the end timestamp back to a date format
                $start_date1 = date('d-m-Y', $start_timestamp);
                $end_date1 = date('d-m-Y', $end_timestamp);

                echo <<<data
          <div class="col-lg-4 col-md-6 package-card mb-4" data-name="$package_data[name]">
                <div class="card h-100 shadow-sm border-0 hover-scale">
                    <div class="position-relative">
                        <img src="$package_thumb" class="card-img-top rounded-top" alt="Package Image" style="height: 200px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-3">
                          <span class="badge rounded-pill bg-danger bg-gradient py-2 text-white">
                              Only $package_data[adult] Left!
                          </span>
                      </div>
                    </div>
                    <div class="card-body pb-0">
                        <h5 class="package-titlename fs-5 fw-bold text-primary mb-3">$package_data[name]</h5>
                        
                        <div class="package-details mb-4">
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center bg-light p-2 rounded">
                                        <i class="fas fa-clock text-muted me-2"></i>
                                        <div>
                                            <small class="d-block text-muted">Duration</small>
                                            <strong>$package_data[duration] Days</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center bg-light p-2 rounded" data-bs-toggle="tooltip" title="1 package is for 1 person">
                                        <i class="fas fa-users text-muted me-2"></i>
                                        <div>
                                            <small class="d-block text-muted">Packages Available</small>
                                            <strong>$package_data[adult]</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center bg-light p-2 rounded mb-3">
                                <span class="text-muted">Travel Mode:</span>
                                <span class="travel-mode-icon">
                                    <i class="text-primary fs-5" data-travel-mode="$package_data[travel_mode]"></i>
                                    <strong>$package_data[travel_mode]</strong>
                                </span>
                            </div>
                        </div>

                        <div class="package-info mb-4">
                            <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                                <span class="text-muted"><i class="bi bi-calendar-check me-2"></i>Start</span>
                                <strong>$start_date1</strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted"><i class="bi bi-calendar-x me-2"></i>End</span>
                                <strong>$end_date1</strong>
                            </div>
                        </div>

                        <div class="facilities-features mb-4">
                            <div class="accordion" id="accordion_$package_data[id]">
                                <div class="accordion-item">
                                    <h5 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapse_$package_data[id]">
                                            Facilities & Features
                                        </button>
                                    </h5>
                                    <div id="collapse_$package_data[id]" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            <div class="facility-content mb-3">
                                                <h6 class="text-secondary fw-bold" style="font-size:15px;">Facilities</h6>
                                                <ul class="list-unstyled">$facilities_data</ul>
                                            </div>
                                            <div class="feature-content">
                                                <h6 class="text-secondary fw-bold " style="font-size:15px;">Features</h6>
                                                <ul class="list-unstyled">$features_data</ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center bg-light py-3 rounded mb-4">
                            <span class="text-muted small">Starting from</span>
                            <h3 class="package-price mb-0">₹$package_data[price] 
                                <small class="text-muted small">/person</small>
                            </h3>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-0 pt-0">
                     
                        $book_btn
                       
                    </div>
                </div>
            </div>
data;
            }
            ?>
        </div>

    </div>

    <script>
        function filterPackages() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let packages = document.querySelectorAll(".package-card");

            packages.forEach((card) => {
                let packageName = card.getAttribute("data-name").toLowerCase();
                if (packageName.includes(input)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }
        function showLoginAlert() {
            alert("danger", "You Need To Login First");
        }


    </script>
    <!-- Bootstrap JS Bundle -->
    <?php include('inc/footer.php'); ?>
</body>

</html>