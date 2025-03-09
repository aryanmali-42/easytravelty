<?php
error_reporting(0);
session_start();
?><!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/styles.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $package_data['name'] ?> | Travel Package</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php require('inc/links.php') ?>

    <style>
        :root {
            --primary-color: #2a2a2a;
            --secondary-color: #4a4a4a;
            --accent-color: #007bff;
            --light-bg: #f8f9fa;
            --border-radius: 12px;
            --box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .package-header {
            background-size: cover;
            background-attachment: fixed;
            padding: 160px 0 80px;
            color: white;
            margin-top: -72px;
            position: relative;
            overflow: hidden;
        }

        .package-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(to top, #f8f9fa, transparent);
            z-index: 1;
        }

        .package-header h1 {
            font-size: 3.5rem;
            font-weight: 800;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
        }

        .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            padding: 12px 20px !important;
            border-radius: 50px;
            backdrop-filter: blur(10px);
        }

        .package-highlights {
            background: white;
            border-radius: var(--border-radius);
            padding: 2.5rem;
            box-shadow: var(--box-shadow);
            position: relative;
            margin-top: -100px;
            z-index: 2;
        }

        .package-gallery {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
        }

        .package-highlights {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--box-shadow);
            position: relative;
            margin-top: -80px;
        }

        .highlight-badge {
            position: absolute;
            top: -25px;
            right: 20px;
            background: var(--accent-color);
            color: white;
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .feature-list {
            list-style: none;
            padding: 0;
        }

        .feature-list li {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }

        .feature-list li i {
            color: var(--accent-color);
            margin-right: 12px;
            font-size: 1.2rem;
            width: 25px;
        }

        .itinerary-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            margin: 2rem 0;
            box-shadow: var(--box-shadow);
        }

        .day-card {
            background: var(--light-bg);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .day-card:hover {
            transform: translateY(-5px);
        }

        .review-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1rem;
        }

        .rating-stars {
            color: #ffc107;
            font-size: 1.1rem;
        }

        .highlight-badge {
            position: absolute;
            top: -30px;
            right: 20px;
            background: linear-gradient(45deg, #007bff, #00c3ff);
            color: white;
            padding: 14px 30px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(0, 195, 255, 0.3);
        }

        .price-tag {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--accent-color);
            margin: 1rem 0;
            position: relative;
            display: inline-block;
        }

        .price-tag::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-color), transparent);
        }


        .booking-card {
            position: sticky;
            top: 100px;
            z-index: 10;
        }

        @media (max-width: 768px) {
            .package-header {
                padding: 100px 0 40px;
                margin-top: -60px;
            }

            .package-highlights {
                margin-top: -40px;
                padding: 1.5rem;
            }

            .highlight-badge {
                font-size: 1rem;
                padding: 8px 20px;
                top: -20px;
            }
        }
    </style>
</head>

<body class="bg-light" style="background-color:#eee">
    <?php include('inc/header.php'); ?>

    <?php
    if (!isset($_GET['id'])) {
        redirect('package.php');
    }

    $data = filteration($_GET);
    $package_res = select("SELECT * FROM `packages` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');
    if (mysqli_num_rows($package_res) == 0) {
        redirect('package.php');
    }
    $package_data = mysqli_fetch_assoc($package_res);
    ?>

    <?php
    $package_thumb = PACKAGE_IMG_PATH . "thumbnail.jpg";
    $thumb_q = mysqli_query($con, "SELECT * FROM `package_image` WHERE `package_id`='$package_data[id]' AND `thumb` ='1'");

    if (mysqli_num_rows($thumb_q) > 0) {
        $thumb_res = mysqli_fetch_assoc($thumb_q);
        $package_thumb = PACKAGE_IMG_PATH . $thumb_res['image'];
    }
    ?>
    <br>
    <header class="package-header">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3 text-dark"><?php echo $package_data['name'] ?></h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.php" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="package.php" class="text-dark">Packages</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">
                        <?php echo $package_data['name'] ?>
                    </li>
                </ol>
            </nav>
        </div>
    </header>
    <br>
    <main class="container">
        <div class="package-highlights">

            <div class="row d-flex flex-column-reverse flex-md-row">
                <div class="col-lg-4">
                    <div class="price-tag">₹<?php echo $package_data['price'] ?><small
                            class="text-muted fs-6">/person</small></div>
                    <div class="d-flex align-items-center mb-3">
                        <?php
                        // Get the average rating
                        $rating_q = "SELECT AVG(rating) AS `avg_rating`, COUNT(*) AS `total_ratings` FROM `rating_review` WHERE `package_id` = '$package_data[id]'";
                        $rating_res = mysqli_query($con, $rating_q);
                        $rating_fetch = mysqli_fetch_assoc($rating_res);

                        if ($rating_fetch['avg_rating'] != NULL) {
                            echo '<div class="rating-stars">';

                            // Display full stars based on the average rating
                            for ($i = 0; $i < floor($rating_fetch['avg_rating']); $i++) {
                                echo '<i class="fas fa-star"></i>';
                            }

                            // Display half-star if the rating has a decimal part
                            if (fmod($rating_fetch['avg_rating'], 1) >= 0.5) {
                                echo '<i class="fas fa-star-half-alt"></i>';
                            }

                            // Show the average rating and the total number of ratings
                            echo '<span class="ms-2 text-muted">(' . number_format($rating_fetch['avg_rating'], 1) . ' from ' . $rating_fetch['total_ratings'] . ' reviews)</span>';
                            echo '</div>';
                        }
                        ?>

                    </div>
                    <!-- In the booking card section -->
                    <div class="card booking-card shadow-lg border-0">
                        <div class="card-body p-4">
                            <h3 class="mb-4 fw-bold text-dark"><i class="fas fa-suitcase me-2"></i>Book Your
                                Package</h3>

                            <!-- Travelers Section -->
                            <?php if (!empty($package_data) && isset($package_data['adult']) && $package_data['adult'] > 0): ?>
                                <div class="mb-4 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="mb-0"><i class="fas fa-user-group me-2 text-secondary"></i>Travelers</h5>
                                        <span class="text-muted small">Max <?php echo $package_data['adult']; ?>
                                            people</span>
                                    </div>
                                    <div class="input-group-lg input-group-custom">
                                        <div class="input-group">
                                            <button type="button" class="btn btn-outline-primary border-end-0"
                                                onclick="adjustQuantity(-1)">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" id="quantity"
                                                class="form-control text-center border-primary bg-light" value="1" min="1"
                                                max="<?php echo $package_data['adult']; ?>" onchange="calculateTotal()">
                                            <button type="button" class="btn btn-outline-primary border-start-0"
                                                onclick="adjustQuantity(1)">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="container mt-3">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>No Package Available !</strong> Choose another package.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            <?php endif; ?>


                            <!-- Pricing Section -->
                            <div class="mb-4 pb-3 border-bottom">
                                <h5 class="mb-3"><i class="fas fa-receipt me-2 text-secondary"></i>Pricing Breakdown
                                </h5>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">₹<?php echo $package_data['price'] ?> x <span
                                            id="travelersCount">1</span></span>
                                    <span class="text-dark">₹<span
                                            id="basePrice"><?php echo $package_data['price'] ?></span></span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Taxes & Fees</span>
                                    <span class="text-success">Included</span>
                                </div>
                            </div>

                            <!-- Total Amount -->
                            <div class="mb-4 pb-3 border-bottom">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0"><i class="fas fa-wallet me-2 text-secondary"></i>Total</h5>
                                    <h2 class="text-success mb-0"><span
                                            id="totalAmount"><?php echo $package_data['price'] ?></span></h2>
                                </div>
                                <p class="text-end small text-muted mb-0">All prices in Indian Rupees</p>
                            </div>

                            <!-- Trip Details -->
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                        <div class="bg-primary text-white rounded-circle p-3 me-3">
                                            <i class="fas fa-calendar-days fa-2x"></i>
                                        </div>
                                        <div>
                                            <p class="small text-muted mb-0">Duration</p>
                                            <h5 class="mb-0"><?php echo $package_data['duration'] ?> Days</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                        <div class="bg-success text-white rounded-circle p-3 me-3">
                                            <i class="fas fa-ticket fa-2x"></i>
                                        </div>
                                        <div>
                                            <p class="small text-muted mb-0">Available</p>
                                            <h5 class="mb-0"><?php echo $package_data['adult'] ?> Packages</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (!$settings_r['shutdown']): ?>
                                <button onclick='checkLoginToBook(<?php echo isset($_SESSION['login']) ? 1 : 0 ?>, 
                     <?php echo $package_data['id'] ?>, document.getElementById("quantity").value)'
                                    class="btn btn-warning btn-lg w-100 py-3 fw-bold hover-effect">
                                    <i class="fas fa-lock me-2"></i>Secure Booking
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <style>
                        .hover-effect {
                            transition: all 0.3s ease;
                            transform: translateY(0);
                        }

                        .hover-effect:hover {
                            transform: translateY(-2px);
                            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
                        }

                        .input-group-custom .form-control {
                            font-size: 1.25rem;
                            font-weight: 600;
                        }

                        .input-group-custom .btn {
                            padding: 0.75rem 1.5rem;
                        }

                        .border-primary {
                            border-color: #0d6efd !important;
                        }
                    </style>
                    <script>
                        let basePrice = <?php echo $package_data['price'] ?>;
                        let maxSeats = <?php echo $package_data['adult'] ?>;

                        function adjustQuantity(change) {
                            let quantityInput = document.getElementById('quantity');
                            let newVal = parseInt(quantityInput.value) + change;
                            if (newVal < 1) newVal = 1;
                            if (newVal > maxSeats) newVal = maxSeats;
                            quantityInput.value = newVal;
                            calculateTotal();
                        }

                        function calculateTotal() {
                            let quantity = parseInt(document.getElementById('quantity').value);
                            document.getElementById('totalAmount').textContent = '₹' + (basePrice * quantity);
                        }

                        // Change function signature to accept quantity
                        function checkLoginToBook(loginStatus, packageId, quantity) {
                            // Add parseInt for quantity
                            quantity = parseInt(quantity);

                            if (loginStatus) {
                                window.location.href = `confirm_booking.php?package_id=${packageId}&quantity=${quantity}`;
                            }
                            else {
                                alert('error', 'First Login');
                            }
                        }
                    </script>
                </div>

                <div class="col-lg-8">
                    <div id="packageCarousel" class="carousel slide package-gallery" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $img_q = mysqli_query($con, "SELECT * FROM `package_image` WHERE `package_id`='$package_data[id]'");
                            if (mysqli_num_rows($img_q) > 0) {
                                $active_class = 'active';
                                while ($img_res = mysqli_fetch_assoc($img_q)) {
                                    echo "<div class='carousel-item $active_class'>
                                                <img src='" . PACKAGE_IMG_PATH . $img_res['image'] . "' class='d-block w-100' alt='Package Image'>
                                            </div>";
                                    $active_class = '';
                                }
                            } else {
                                echo "<div class='carousel-item active'>
                                            <img src='" . PACKAGE_IMG_PATH . "thumbnail.jpg' class='d-block w-100' alt='Package Image'>
                                        </div>";
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#packageCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#packageCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-lg-12">

                <div class="itinerary-section">
                    <div class="itinerary-header">
                        <div class="itinerary-icon">
                            <i class="fas fa-file-alt text-dark"></i>
                        </div>
                        <h3>Package Details</h3>
                    </div>
                    <p>
                        <?php echo nl2br(html_entity_decode($package_data['description'])); ?>
                    </p>

                    <div class="row g-4 mt-3">
                        <div class="col-md-6">
                            <div class="day-card">
                                <h4><i class=" fas fa-check-circle me-2"></i>Features</h4>
                                <ul class="feature-list">
                                    <?php
                                    $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
                                        INNER JOIN `package_features` pfea ON f.id = pfea.features_id 
                                        WHERE pfea.package_id='$package_data[id]'");
                                    while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                                        echo '<div style="animation-delay: ' . ($index * 0.1) . 's"><li><i class="fas fa-check text-success"></i>' . $fea_row['name'] . '</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="day-card">
                                <h4><i class="fas fa-check-circle me-2"></i>Facilities</h4>
                                <ul class="feature-list">
                                    <?php
                                    $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f 
                                        INNER JOIN `package_facilities` pfac ON f.id=pfac.facilities_id 
                                        WHERE pfac.package_id='$package_data[id]'");
                                    while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                                        echo '<li><i class="fas fa-check text-success"></i>' . $fac_row['name'] . '</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    :root {
                        --primary-accent: #ffc107;
                        --timeline-width: 3px;
                    }

                    .itinerary-section {
                        background: #ffffff;
                        border-radius: 16px;
                        padding: 2.5rem;
                        position: relative;
                        box-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.05);
                    }

                    .itinerary-header {
                        display: flex;
                        align-items: center;
                        gap: 1rem;
                        margin-bottom: 3rem;
                    }

                    .itinerary-icon {
                        background: var(--primary-accent);
                        width: 50px;
                        height: 50px;
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        box-shadow: 0 4px 6px rgba(79, 70, 229, 0.15);
                    }

                    .itinerary-header h3 {
                        font-size: 1.75rem;
                        color: #1f2937;
                        margin: 0;
                        font-weight: 700;
                        letter-spacing: -0.5px;
                    }

                    .timeline-container {
                        position: relative;
                        padding-left: 30px;
                    }

                    .timeline-line {
                        position: absolute;
                        left: 10px;
                        top: 0;
                        width: var(--timeline-width);
                        height: 100%;
                        background: #e5e7eb;
                        border-radius: 4px;
                    }

                    .day-card {
                        position: relative;
                        margin: 2rem 0;
                        padding: 2rem;
                        background: #fff;
                        border-radius: 16px;
                        border: 1px solid #f3f4f6;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                        cursor: pointer;
                        overflow: hidden;
                    }

                    .day-card::before {
                        content: '';
                        position: absolute;
                        left: -29px;
                        top: 24px;
                        width: 20px;
                        height: 20px;
                        background: var(--primary-accent);
                        border: 4px solid #fff;
                        border-radius: 50%;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
                        z-index: 2;
                    }

                    .day-card:hover {
                        transform: translateX(10px);
                        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
                        border-color: #e0e7ff;
                    }

                    .day-card-header {
                        display: flex;
                        align-items: center;
                        gap: 1rem;
                        margin-bottom: 1.5rem;
                    }

                    .day-number {
                        background: var(--primary-accent);
                        color: black;
                        width: 40px;
                        height: 40px;
                        border-radius: 10px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-weight: 700;
                        flex-shrink: 0;
                    }

                    .day-content {
                        color: #4b5563;
                        line-height: 1.75;
                        position: relative;
                        padding-left: 24px;
                    }

                    .day-content::before {
                        content: '•';
                        position: absolute;
                        left: 0;
                        color: #9ca3af;
                        font-size: 1.5em;
                        line-height: 1;
                        top: 2px;
                    }

                    .day-card:hover .day-content {
                        color: #374151;
                    }

                    /* Responsive Design */
                    @media (max-width: 768px) {
                        .itinerary-section {
                            padding: 1.5rem;
                        }

                        .timeline-container {
                            padding-left: 20px;
                        }

                        .day-card {
                            padding: 1.5rem;
                            margin: 1.5rem 0;
                        }

                        .day-card::before {
                            left: -24px;
                            width: 16px;
                            height: 16px;
                        }
                    }

                    /* Animation */
                    @keyframes fadeIn {
                        from {
                            opacity: 0;
                            transform: translateY(10px);
                        }

                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }

                    .day-card {
                        animation: fadeIn 0.6s ease forwards;
                        opacity: 0;
                    }

                    .day-card:nth-child(1) {
                        animation-delay: 0.1s;
                    }

                    .day-card:nth-child(2) {
                        animation-delay: 0.2s;
                    }

                    .day-card:nth-child(3) {
                        animation-delay: 0.3s;
                    }

                    /* Continue pattern as needed */
                </style>

                <div class="itinerary-section">
                    <div class="itinerary-header">
                        <div class="itinerary-icon">
                            <i class="fas fa-route text-dark"></i>
                        </div>
                        <h3>Journey Plan</h3>
                    </div>

                    <div class="timeline-container">
                        <div class="timeline-line"></div>

                        <?php
                        $itinerary_items = explode("\n", $package_data['iternity']);
                        foreach ($itinerary_items as $index => $item) {
                            if (!empty(trim($item))) {
                                echo '<div class="day-card" style="animation-delay: ' . ($index * 0.1) . 's">
                        <div class="day-card-header">
                            <div class="day-number">' . ($index + 1) . '</div>
                            <h5 class="mb-0 text-lg font-semibold">Day ' . ($index + 1) . '</h5>
                        </div>
                        <div class="day-content">' . trim($item) . '</div>
                    </div>';
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="itinerary-section">
                    <div class="itinerary-header">
                        <div class="itinerary-icon">
                            <i class="fas fa-comments me-2 text-dark"></i>
                        </div>
                        <h3>Traveler Reviews</h3>
                    </div>

                    <?php
                    $review_q = "SELECT rr.*, uc.name AS uname, uc.profile FROM `rating_review` rr 
                                    INNER JOIN `user_cred` uc ON rr.user_id=uc.id
                                    WHERE rr.package_id='$package_data[id]'
                                    ORDER BY `sr_no` DESC LIMIT 4";
                    $review_res = mysqli_query($con, $review_q);

                    if (mysqli_num_rows($review_res) > 0) {
                        while ($row = mysqli_fetch_assoc($review_res)) {
                            echo '<div class="review-card">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="' . USERS_IMG_PATH . $row['profile'] . '" class="avatar">
                                            <div>
                                                <h5 class="mb-0">' . $row['uname'] . '</h5>
                                                <div class="rating-stars">';
                            for ($i = 0; $i < $row['rating']; $i++) {
                                echo '<i class="fas fa-star"></i>';
                            }
                            echo '</div>
                                            </div>
                                        </div>
                                        <p class="text-muted">' . $row['review'] . '</p>
                                    </div>';
                        }
                    } else {
                        echo '<p class="text-muted">No reviews yet. Be the first to review this package!</p>';
                    }
                    ?>
                </div>
            </div>


        </div>
    </main>

    <?php include('inc/footer.php'); ?>
</body>

</html>