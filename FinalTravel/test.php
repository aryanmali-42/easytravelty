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

    <!-- Bootstrap CSS -->

    <?php require('inc/links.php') ?>
    <style>
        h5 {
            font-size: 18px;
        }

        body {
            background-color: #eee;
            font-family: 'Arial', sans-serif;
        }

        .card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 10px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .features,
        .facilities {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h5,
        h6 {
            font-family: 'Arial', sans-serif;
        }

        h6 {
            font-size: 1.5rem;
        }

        .feature-content,
        .facility-content {
            font-size: 19px !important;
            line-height: 1.6;
        }

        .text-primary {
            color: #007bff;
        }

        .text-secondary {
            color: #6c757d;
        }

        .text-success {
            color: #28a745;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 1.1rem;
        }

        .btn-secondary {}

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-outline-secondary {

            background-color: white !important;
            border-color: black !important;
            font-size: 1.1rem;
            color: black !important;
        }

        .btn-outline-secondary:hover {
            background-color: rgba(108, 117, 125, 0.1);
        }




        .package-card {
            margin-bottom: 30px;
        }

        .search-container {
            max-width: 500px;
            margin: 20px auto;
        }

        .search-box {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body class="bg-light" style="background-color:#eee">

    <br><br><br>
    <div class="my-5 px-4 facilities">
        <h2 class="fw-bold h-font text-center">OUR PACKAGE</h2>
        <div class="h-line bg-dark"></div>
    </div><!-- Search Bar -->
    <div class="search-container">
        <input type="text" id="searchInput" class="search-box" placeholder="Search packages..."
            onkeyup="filterPackages()">
    </div>
    <div class="container-fluid">
        <div class="row">


            <div class="col-lg-12 col-md-12 mb-lg-6 mb-4 ">
                <?php
                $package_res = select("SELECT * FROM `packages` WHERE `status`=? AND `removed`=?", [1, 0], 'ii');
                while ($package_data = mysqli_fetch_assoc($package_res)) {
                    //get features from room 
                    // inner join use krto
                    $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `package_features` pfea ON f.id = pfea.features_id WHERE pfea.package_id='$package_data[id]'");
                    $features_data = "";
                    while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                        $features_data .= "   <span class='badge rounded-pill bg-light text-dark  text-wrap  me-1 mb-1'>
                                 $fea_row[name]
                                </span>";
                    }
                    //get facilities from room 
                    $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f 
                    INNER JOIN `package_facilities` pfac ON f.id=pfac.facilities_id WHERE pfac.package_id='$package_data[id]'");
                    $facilities_data = "";

                    while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                        $facilities_data .= "<span class='badge rounded-pill bg-light text-dark  text-wrap  me-1 mb-1'>
                                 $fac_row[name]
                                </span>";
                    }

                    //get thumbnails
                    $package_thumb = PACKAGE_IMG_PATH . "thumbnail.jpg";
                    $thumb_q = mysqli_query($con, "SELECT * FROM `package_image` WHERE `package_id`='$package_data[id]' AND `thumb` ='1'");
                    if (mysqli_num_rows($thumb_q) > 0) {
                        $thumb_res = mysqli_fetch_assoc(result: $thumb_q);
                        $package_thumb = PACKAGE_IMG_PATH . $thumb_res['image'];
                    }
                    $book_btn = "";
                    if (!$settings_r['shutdown']) {
                        $login = 0;
                        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                            $login = 1;
                        }
                        $book_btn = "  <button onclick='checkLoginToBook($login,$package_data[id])'  class='btn btn-warning btn-lg shadow-sm'>
                                                    <i class='fas fa-shopping-cart me-2'></i>Book Now
                                                </button>";
                    }
                    //print room card
                    $start_date = $package_data['date']; // Start date from your database
                    $duration = $package_data['duration']; // Duration in days from the database
                
                    // Convert start date to a timestamp
                    $start_timestamp = strtotime($start_date);

                    // Add duration (in days) to the start date
                    $end_timestamp = strtotime("+$duration days", $start_timestamp);

                    // Convert the end timestamp back to a date format
                    $end_date = date('Y-m-d', $end_timestamp);
                    $end_date1 = date('d-m-Y', $end_timestamp);
                    echo <<<data
                              <div class="card mb-4 border-0 shadow-lg overflow-hidden package-card" data-name="$package_data[name]">
                                    <div class="row g-0 align-items-center">
                                        <!-- Image Section -->
                                        <div class="col-md-4 position-relative">
                                            <img src="$package_thumb" class="img-fluid h-100 object-fit-cover" alt="Package Image" style="min-height: 300px;">
                                            <div class="ribbon bg-warning text-dark px-4 py-2 shadow-sm">
                                                <i class="fas fa-star me-2"></i>Best Seller
                                            </div>
                                        </div>

                                        <!-- Details Section -->
                                        <div class="col-md-6 p-4">
                                            <h3 class="mb-3 text-dark fw-bold">$package_data[name]</h3>
                                            
                                            <!-- Key Information Grid -->
                                            <div class="row g-3 mb-4">
                                                <div class="col-6 col-md-4">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-clock text-primary me-2"></i>
                                                        <div>
                                                            <small class="text-muted d-block ">Duration</small>
                                                            <strong>$package_data[duration] Days</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-users text-primary me-2"></i>
                                                        <div>
                                                            <small class="text-muted d-block">People</small>
                                                            <strong>$package_data[adult]</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="d-flex align-items-center">
                                                            <i class="text-primary me-2" data-travel-mode="$package_data[travel_mode]"></i>

                                                        <div>
                                                            <small class="text-muted d-block">Travel Mode</small>
                                                            <strong>$package_data[travel_mode]</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                     

                                            <!-- Features & Facilities -->
                                            <div class="row g-3">
                                           <div class="facilities mb-3">
                                            <h6 class="mb-1 text-secondary fw-bold">Facilities</h6>
                                            <p class="text-muted facility-content">$facilities_data</p>
                                        </div>
                                                <div class="features mb-3">
                                            <h6 class="mb-1 text-secondary fw-bold">Features</h6>
                                            <p class="text-muted feature-content">$features_data</p>
                                    </div>
                                    
                                            </div>
                                        </div>

                                        <!-- Price & Actions -->
                                        <div class="col-md-2 bg-light border-start p-4 text-center">
                                         <div class="d-flex gap-4 text-muted mb-3">
                                    <div>
                                        <i class="bi bi-calendar-check me-2"></i>
                                        Start: {$package_data['date']}
                                    </div>
                                    <div>
                                        <i class="bi bi-calendar-x me-2"></i>
                                    End:ㅤㅤ$end_date1
                                    </div>
                                </div>
                                            <div class="mb-4">
                                                <span class="text-muted d-block">Starting from</span>
                                                <h2 class="text-success fw-bold my-2">₹$package_data[price]</h2>
                                                <small class="text-muted">per person</small>
                                            </div>

                                            <div class="d-grid gap-3">
                                                <div class="alert alert-danger py-2">
                                                    <i class="fas fa-exclamation-circle me-2"></i>
                                                    Only $package_data[adult] Package left!
                                                </div>
                                              $book_btn
                                                <a href="package_details.php?id=$package_data[id]" class="btn btn-outline-dark btn-lg">
                                                    <i class="fas fa-info-circle me-2"></i>Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                                                        document.addEventListener("DOMContentLoaded", function() {
                                                    document.querySelectorAll("[data-travel-mode]").forEach(icon => {
                                                        let travelMode = icon.getAttribute("data-travel-mode");
                                                        if (travelMode === "train") {
                                                            icon.className = "fas fa-train text-primary me-2";
                                                        } else if (travelMode === "bus") {
                                                            icon.className = "fas fa-bus text-primary me-2";
                                                        } else {
                                                            icon.className = "fas fa-plane text-primary me-2";
                                                        }
                                                    });
                                                });

                                </script>

                                <style>
                                .ribbon {
                                    position: absolute;
                                    top: 20px;
                                    right: -30px;
                                    transform: rotate(45deg);
                                    font-weight: 600;
                                    font-size: 0.9rem;
                                    width: 150px;
                                    text-align: center;
                                }

                                .object-fit-cover {
                                    object-fit: cover;
                                    object-position: center;
                                }

                                .border-start {
                                    border-left: 1px solid rgba(0,0,0,0.1) !important;
                                }
                                </style>


                    data;
                }
                ?>


            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->

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
    </script>
    <?php include('inc/footer.php'); ?>
</body>

</html>