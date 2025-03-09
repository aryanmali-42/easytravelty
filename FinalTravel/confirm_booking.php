<?php
error_reporting(0);
session_start();
?><!DOCTYPE html>
<html lang="en">

<head>


    <?php require('inc/links.php') ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONFIRM BOOKING</title>
    <link rel="stylesheet" href="css/styles.css">

    <!-- Bootstrap CSS -->


    <style>
        .row label {
            font-weight: 500;
        }

        .row input {
            padding-bottom: 3px;
            font-size: 15px;

        }

        .row textarea {
            padding-bottom: 3px;
            font-size: 15px;
        }

        .ribbon {
            position: absolute;
            top: 10px;
            left: -10px;
            background: #ff4757;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            transform: rotate(-45deg);
            z-index: 1;
        }

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
            font-size: 1.2rem;
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

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-outline-secondary {
            border-color: #6c757d;
            font-size: 1.1rem;
        }

        .btn-outline-secondary:hover {
            background-color: rgba(108, 117, 125, 0.1);
        }

        .badge {
            font-size: 1.2rem;
            padding: 0.5em 1em;
        }

        .seatsavail {
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {

            .features,
            .facilities {
                background-color: rgb(255, 255, 255);
                padding: 15px;
                border-radius: 8px;

            }

        }

        /* Responsive styles for smaller screens */
        @media (max-width: 768px) {

            .col-md-5,
            .col-md-2 {
                text-align: center;
            }

            .row.g-0 {
                flex-direction: column;
                align-items: center;
            }

            .col-md-5,
            .col-md-2 {
                margin-bottom: 20px;
            }

            .card {
                padding: 10px;
            }

            .features,
            .facilities {
                padding: 10px;
            }

            .feature-content,
            .facility-content {
                font-size: 1rem;
            }

            .seatsavail {
                font-size: 1rem;
            }

            .roombtn {
                margin-top: 15px;
            }

            .btn {
                font-size: 1rem;
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<?php include('inc/header.php'); ?>

<body class="bg-light" style="background-color:#eee">
    <?php
    //  CHECK package id from  URL IS PRESENT OR NOT
    // shutdown mode is active or Not
    // user is logged in or not
    if (!isset($_GET['package_id']) || $settings_r['shutdown'] == true) {
        redirect('package.php');
    } else if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('package.php');
    }
    //filter and get package and user data
    

    $data = filteration($_GET);
    $package_res = select("SELECT * FROM `packages` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['package_id'], 1, 0], 'iii');
    if (mysqli_num_rows($package_res) == 0) {
        redirect('package.php');
    }
    $package_data = mysqli_fetch_assoc($package_res);
    $_SESSION['package'] = [
        "id" => $package_data['id'],
        "name" => $package_data['name'],
        "price" => $package_data['price'],
        "quantity" => $quantity,
        "total_price" => $total_price,
        "payment" => null,
        "available" => false,
    ];
    $user_res = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], "i");
    $user_data = mysqli_fetch_assoc($user_res);

    // After getting package_data
    $quantity = isset($_GET['quantity']) ? (int) $_GET['quantity'] : 1;

    // Validate quantity
    if ($quantity < 1 || $quantity > $package_data['adult']) {
        redirect('package.php');
    }

    // Calculate total price
    $total_price = $package_data['price'] * $quantity;
    ?>
    <br><br><br>

    <div class="container">
        <div class="row">
            <!-- Breadcrumbs Section -->
            <div class="col-12 mt-4 mb-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="font-size: 14px;">
                        <li class="breadcrumb-item"><a href="index.php"
                                class="text-secondary text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="package.php"
                                class="text-secondary text-decoration-none">Packages</a></li>
                        <li class="breadcrumb-item active text-dark" aria-current="page">Confirm Booking</li>
                    </ol>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-12 mb-4">
                <h2 class="fw-bold mb-4">Confirm Your Booking</h2>
            </div>

            <div class="col-lg-7 col-md-12 mb-4">
                <div class="card border-0 shadow-lg rounded-3">
                    <div class="card-body p-4">
                        <?php
                        $package_thumb = PACKAGE_IMG_PATH . "thumbnail.jpg";
                        $thumb_q = mysqli_query($con, "SELECT * FROM `package_image` WHERE `package_id`='$package_data[id]' AND `thumb` ='1'");
                        if (mysqli_num_rows($thumb_q) > 0) {
                            $thumb_res = mysqli_fetch_assoc(result: $thumb_q);
                            $package_thumb = PACKAGE_IMG_PATH . $thumb_res['image'];
                        }
                        // ... existing PHP code ...
                        // Assuming 'duration' is the number of days for the package duration
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
                                <img src="$package_thumb" class="img-fluid rounded-3 mb-4" style="height: 300px; object-fit: cover;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h3 class="fw-bold mb-0">$package_data[name]</h3>
                                    <span class="badge bg-primary fs-6">₹$package_data[price]</span>
                                </div>
                                <div class="d-flex gap-4 text-muted mb-3">
                                    <div>
                                        <i class="bi bi-calendar-check me-2"></i>
                                        Start: {$package_data['date']}
                                    </div>
                                    <div>
                                        <i class="bi bi-calendar-x me-2"></i>
                                        End: $end_date1
                                    </div>
                                </div>
                                <p class="text-muted mb-0">{$package_data['duration']} Days Package</p>
                    data;
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-12">
                <div class="card border-0 shadow-lg rounded-3">
                    <div class="card-body p-4">
                        <h4 class="mb-4 fw-bold">Booking Details</h4>
                        <form id="paymentForm" method="POST">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-500 text-dark">Full Name</label>
                                    <input name="name" type="text" value="<?php echo $user_data['name']; ?>"
                                        class="form-control shadow-sm rounded-2" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-500 text-dark">Phone Number</label>
                                    <input name="phonenum" type="text" value="<?php echo $user_data['phonenum']; ?>"
                                        class="form-control shadow-sm rounded-2" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-500 text-dark">Address</label>
                                    <textarea name="address" class="form-control shadow-sm rounded-2" rows="3"
                                        readonly><?php echo $user_data['address']; ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-500 text-dark">Start Date</label>
                                    <input name="startdate" type="date" class="form-control shadow-sm rounded-2"
                                        id="startdate" value="<?php echo $package_data['date']; ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-500 text-dark">End Date</label>
                                    <input name="enddate" type="date" class="form-control shadow-sm rounded-2"
                                        id="enddate" value="<?php echo $end_date; ?>" readonly>
                                    <small class="text-muted">* Calculated based on package duration</small>
                                </div>

                                <!-- Hidden Fields -->
                                <input type="hidden" name="package_id" value="<?php echo $package_data['id']; ?>">
                                <input type="hidden" name="package_name" value="<?php echo $package_data['name']; ?>">
                                <input type="hidden" name="price" value="<?php echo $package_data['price']; ?>">
                                <input type="hidden" name="pay_now" value="1">
                                <!-- Add this with other hidden fields -->
                                <input type="hidden" name="quantity" value="<?php echo $quantity ?>">

                                <!-- Price Summary -->
                                <!-- Price Summary -->
                                <div class="col-12 mt-4 bg-light p-3 rounded-2">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="fw-500">Travelers:</span>
                                        <span class="text-primary"><?php echo $quantity ?> Person(s)</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-500">Total Amount:</span>
                                        <span class="h4 fw-bold text-primary">₹<?php echo $total_price ?></span>
                                    </div>
                                    <div class="text-end text-muted small">
                                        (₹<?php echo $package_data['price'] ?> × <?php echo $quantity ?> persons)
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-2">
                                        <i class="bi bi-credit-card me-2"></i>Pay Now
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .breadcrumb {
            padding: 0.75rem 1rem;
            background-color: #f8f9fa;
            border-radius: 0.5rem;
        }

        .badge {
            padding: 0.5em 0.75em;
        }
    </style>
    <!-- Bootstrap JS Bundle -->


    <?php include('inc/footer.php');

    require('vendor/autoload.php');

    use Razorpay\Api\Api; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>

        $(document).ready(function () {
            $("#paymentForm").submit(function (e) {
                e.preventDefault(); // Prevent normal form submission

                var formData = $(this).serialize(); // Serialize form dataonverts the form data into a string format that can be sent in an HTTP reques

                $.ajax({
                    url: "payment-process.php",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            var options = {
                                "key": "rzp_test_TK48ysqhbMKZFG", // Replace with your Razorpay Key ID
                                "amount": response.amount * 100, // Amount in paise
                                "name": "Aryan Mali",
                                "description": response.package_name,
                                "image": "https://example.com/your_logo",
                                "handler": function (paymentResponse) {
                                    $.ajax({
                                        url: "payment-success.php",
                                        type: "POST",
                                        data: {
                                            payment_id: paymentResponse.razorpay_payment_id,
                                            package_id: response.package_id
                                        },
                                        success: function (finalResponse) {
                                            console.log(finalResponse); // Debug the response from PHP
                                            if (finalResponse === "done") {
                                                window.location.href = "http://localhost/finaltravel/success.php";
                                            } else {
                                                alert("Payment successful, but error in database update.");
                                            }
                                        }
                                    });
                                },
                                "theme": {
                                    "color": "#3399cc"
                                }
                            };
                            var rzp = new Razorpay(options);
                            rzp.open();
                        } else {
                            alert("Error processing payment. Try again.");
                        }
                    }
                });
            });
        });

    </script>


</body>

</html>