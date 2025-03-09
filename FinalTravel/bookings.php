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
        h5 {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<?php include('inc/header.php');

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}
?>

<class="bg-light" style="background-color:#eee">

    <br><br><br>

    <div class="container my-5">
        <div class="row">
            <div class="col-12 mb-4">
                <h1 class="fw-bold text-primary"><?php echo $_SESSION['uName'] ?> Bookings</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bookings</li>
                    </ol>
                </nav>
            </div>

            <?php
            $query = "SELECT bo.*,bd.* FROM `orders` bo
                INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
                WHERE ((bo.booking_status='booked') 
                OR (bo.booking_status='cancelled'))
                AND (bo.user_id=?)
                ORDER BY bo.booking_id desc";

            $result = select($query, [$_SESSION['uId']], 'i');
            while ($data = mysqli_fetch_array($result)) {
                $date = date("d-m-Y", strtotime($data['added_date']));
                $status_bg = "";
                $btn = "";
                if ($data['booking_status'] == 'booked') {
                    $status_bg = "success";
                    $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-sm btn-outline-primary me-2'>Download PDF</a>";
                    $query1 = "SELECT `date` FROM `packages` WHERE `id`=? ";
                    $result1 = select($query1, [$data['package_id']], 'i');
                    $data1 = mysqli_fetch_array($result1);
                    $current_date = date("Y-m-d"); // Get today's date
                    $booking_date = date("Y-m-d", strtotime($data1['date'])); // Fetch booking_date from package table
            
                    if ($data['refund'] == 0 && $current_date < $booking_date) {
                        $btn .= "<button type='button' onclick='cancel_booking($data[booking_id])' class='btn btn-sm btn-outline-danger'>
                                Cancel Booking
                             </button>";
                    }
                    if ($data['rate_review'] == 1) {
                        $btn .= "<button type='button' onclick='review_package($data[booking_id],$data[package_id])' class='ms-2 btn btn-sm btn-outline-success'  data-bs-toggle='modal'
                                data-bs-target='#reviewModal'>
                                 Rate & Review
                              </button>";
                    }
                } elseif ($data['booking_status'] == 'cancelled') {
                    $status_bg = "danger";
                    if ($data['refund'] == 0) {
                        $btn = "<span class='badge bg-warning text-dark'>Refund In Process</span>";
                    } else {
                        $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-sm btn-outline-primary'>Download PDF</a>";
                    }
                }
                echo <<<bookings
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm hover-shadow transition">
                        <div class="card-body">
                            <h5 class="card-title text-primary">$data[package_name]</h5>
                            <h6 class="card-subtitle mb-2 text-muted">₹$data[price] Per Package</h6>
                            <p class="card-text">
                                <strong>Total Paid:</strong> ₹$data[totalprice]<br>
                                <strong>Order ID:</strong> $data[booking_id]<br>
                                <strong>Total Travellers:</strong> $data[quantity]<br>
                                <strong>Date:</strong> $date
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-$status_bg">$data[booking_status]</span>
                                <div class="btn-group">
                                    $btn
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            bookings;

            }
            ?>
        </div>
    </div>
    <!-- MODFAL -->
    <div class="modal fade" id="reviewModal" aria-hidden="true" aria-labelledby="loginModalLabel" tabindex="-1">
        <div class="modal-dialog rounded modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="loginModalLabel">
                        <i class="bi bi-chat-square-heart-fill fs-3 me-2"></i> Rate And Review
                    </h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="review-form" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="emailInput" class="form-label">Rating</label>
                            <select class="form-select shadow-none" name="rating" style="font-size:15px">
                                <option selected>Open this select menu</option>
                                <option value="5">Excellent</option>
                                <option value="4">Good</option>
                                <option value="3">Ok</option>
                                <option value="2">Poor</option>
                                <option value="1">Bad</option>
                            </select>

                        </div>
                        <div class="mb-4">
                            <label for="passwordInput" class="form-label">Review</label>
                            <textarea style="font-size:15px" type="text" name="review" rows="3"
                                class="form-control shadow-none" required></textarea>

                            <input type="hidden" name="booking_id">
                            <input type="hidden" name="package_id">

                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn-sm custombg">Confirm Review</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <style>
        .hover-shadow:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .transition {
            transition: all 0.3s ease;
        }

        .card {
            border: none;
            border-radius: 0.5rem;
        }

        .card-title {
            font-size: 1.25rem;
        }

        .badge {
            font-size: 13px;
            padding: 0.5em 0.75em;
        }

        .btn-sm {
            font-size: 13px;
        }

        @media (max-width: 768px) {
            font-size: 7px;
        }
    </style>


    <!-- Bootstrap JS Bundle -->


    <?php include('inc/footer.php'); ?>
    <script>
        function cancel_booking(id) {
            if (confirm("Are you sure you want to cancel this booking?")) {

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/cancel_bookings.php", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function () {
                    if (this.responseText.trim() == "1") {
                        window.location.href = "bookings.php?cancel_status=true";
                    } else {
                        alert('Cancellation Failed. Please try again.');
                    }
                }

                xhr.send('cancel_booking=true&id=' + id);
            }
        }
        let review_form = document.getElementById('review-form');
        function review_package(bid, pid) {
            review_form.elements['booking_id'].value = bid;
            review_form.elements['package_id'].value = pid;
        }
        review_form.addEventListener('submit', function (e) {
            e.preventDefault();
            let data = new FormData();
            data.append('review_form', '');
            data.append('rating', review_form.elements['rating'].value);
            data.append('review', review_form.elements['review'].value);
            data.append('booking_id', review_form.elements['booking_id'].value);
            data.append('package_id', review_form.elements['package_id'].value);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/review_package.php", true);
            xhr.onload = function () {
                if (this.responseText == 1) {
                    window.location.href = 'bookings.php?review_status=true';
                }
                else {
                    var myModal = document.getElementById('reviewModal');
                    var modal = bootstrap.Modal.getInstance(myModal);
                    modal.hide();
                    alert('error', "Rating And Review failed !!");
                }
                // else if (this.responseText == 0) {
                //     alert('error', 'no changes made');
                // }
                // else {
                //     alert('success', 'Profile Updated Successfully');
                // }
            }
            xhr.send(data);
        });



    </script>
    <?php
    if (isset($_GET['cancel_status'])) {
        alert('success', 'Booking Cancelled');
    } else if (isset($_GET['review_status'])) {
        alert('success', 'Review Submitted Successfully');

    }
    ?>
    </body>

</html>