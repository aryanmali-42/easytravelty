<?php
error_reporting(0);
session_start();
date_default_timezone_set("Asia/Kolkata");
require('connection.php');
require('admin/inc/essentials.php');

$settings_q = "SELECT * FROM `settings` WHERE `sr_no` = ?";
$values = [1];
$settings_r = mysqli_fetch_assoc(select($settings_q, $values, 'i'));
if ($settings_r['shutdown']) {
    echo <<<alertbar
        <div class="bg-danger text-center p-2 fw-bold fixed-top" style="z-index: 9999;">
        <i class="bi bi-exclamation-triangle-fill"></i>  
            Bookings Are Temporarily closed!
        </div>
    alertbar;
}
?>

<style>
    /* Navbar */
    .navbar {
        transition: background-color 0.3s ease, padding 0.3s ease;
    }

    .navbar.navbar-dark .nav-link {
        color: rgba(255, 255, 255, 0.8);
    }

    .navbar.navbar-dark .nav-link:hover {
        color: #ffc107;
        /* Highlight color */
    }

    .modal-backdrop {
        display: none !important;
    }

    .modalback {
        backdrop-filter: blur(5px);
        /* Adjust blur intensity */
        background-color: rgba(0, 0, 0, 0.2) !important;
        /* Light transparent black */
    }

    .navbar.fixed-top.scrolled {
        background-color: rgba(0, 0, 0, 0.8);
    }

    .navbar-toggler {
        border: none;
    }

    .navbar-toggler-icon {
        filter: invert(1);
    }


    * {
        font-family: 'Poppinsans', sans-serif;
    }

    .modal-dialog,
    {
    max-width: 600px;
    /* Restrict modal width */
    }

    .modal-dialog input {
        font-size: 15px;
    }

    .modal-content {
        padding: 10px;
        /* Adjust padding */
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }


    /* Default font color for navbar items (white) */
    .navbar-nav .nav-link,
    .navbar-brand,
    .btn-outline-light {
        color: white;
    }

    /* Font color for navbar items, brand name, and buttons after scrolling down (black) */
    .navbar-scrolled .nav-link,
    .navbar-scrolled .navbar-brand,
    .navbar-scrolled .btn-outline-light {
        color: black !important;
    }

    /* Blur background content when modal is open */
    body.modal-open .content,
    body.modal-open .navbar {
        filter: blur(3px);
        transition: filter 0.3s ease-in-out;
    }
</style>

<nav class="navbar navbar-expand-xl navbar-dark bg-transparent px-lg-3 py-lg-2 shadow-sm fixed-top"
    style="background-color: rgba(0, 0, 0, 0.3); backdrop-filter: blur(10px);">
    <div class="container-fluid  d-flex justify-content-between">
        <h1 class="fw-bold ">
            <a class=" navbar-brand t-font text-white" href="index.php" style="font-size: 3.5rem;">
                <?php echo $settings_r['site_title']; ?>
            </a>
        </h1>
        <button class="navbar-toggler shadow-none " type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0"> -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0"> <!-- 'mx-auto' centers the nav items -->
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold me-3" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold me-3" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold me-3" href="package.php">Packages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold me-3" href="contact.php">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold me-3" href="facilities.php">Reviews</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php

                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                    $path = USERS_IMG_PATH;
                    echo <<<data
                                 <div class="btn-group" style="width:130px; ">
                                    <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" style="font-size:15px;">
                                    <img src="$path$_SESSION[uPic]" style="width:25px;height:25px;" class="rounded-circle me-1"> 
                                    $_SESSION[uName]
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-lg-end">
                                        <li><a class="dropdown-item" href="profile.php" style="font-size:13px;">Profile</a></li>
                                        <li><a class="dropdown-item" href="bookings.php" style="font-size:13px;">Bookings</a></li>
                                        <li><a class="dropdown-item" href="logout.php" style="font-size:13px;">LogOut</a></li>
                                    </ul>
                                    </div>
                        data;
                } else {
                    echo <<<data
                                    <button type="button" class="btn btn-outline-light shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                                          Login
                                          </button>
                                <button type="button" class="btn btn-outline-light shadow-none" data-bs-toggle="modal"data-bs-target="#registerModal">
                                    Register
                                </button>
                        data;



                }

                ?>

            </div>
        </div>
    </div>
</nav>


<div class="modal fade" id="loginModal" aria-hidden="true" aria-labelledby="loginModalLabel" tabindex="-1">
    <div class="modal-dialog rounded ">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="loginModalLabel">
                    <i class="bi bi-person-circle fs-3 me-2"></i> User Login
                </h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="login-form" class="needs-validation" novalidate onsubmit="return validateLoginForm()">
                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email/Mobile</label>
                        <input type="text" name="email_mob" id="emailInput" class="form-control shadow-none" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address or mobile number.
                        </div>
                    </div>
                    <div class="mb-4 position-relative">
                        <label for="passwordInput" class="form-label">Password</label>
                        <input type="password" name="pass" id="passwordInput" class="form-control shadow-none" required>
                        <div class="invalid-feedback">
                            Please enter your password.
                        </div>
                        <button type="button"
                            class="shadow-none btn position-absolute top-50 end-0 translate-middle-y mt-4"
                            id="togglePassword">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <button type="submit" class="btn btn-dark shadow-none">Login</button>

                        <button type="button" class="btn text-secondary text-decoration-none shadow-none p-0"
                            data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#forgotModal">
                            Forget Password?
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Custom validation for the login form
    function validateLoginForm() {
        const form = document.getElementById('login-form');
        const emailInput = form.email_mob.value;
        const passwordInput = form.pass.value;

        // Regular expression for email validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        // Regular expression for mobile number validation (10 digits)
        const mobilePattern = /^\d{10}$/;

        // Check if the input is a valid email or mobile number
        if (!emailPattern.test(emailInput) && !mobilePattern.test(emailInput)) {
            alert("Please enter a valid email address or a 10-digit mobile number.");
            return false;
        }

        // If all validations pass
        return true;
    }

    // Bootstrap validation


    // Show/Hide Password Functionality
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('passwordInput');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle the eye icon
        eyeIcon.classList.toggle('bi-eye');
        eyeIcon.classList.toggle('bi-eye-slash');
    });
</script>

<!-- Include Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


<div class="modal fade" id="registerModal" aria-hidden="true" aria-labelledby="loginModalLabel" tabindex="-1">
    <div class="modal-dialog rounded ">
        <div class="modal-content">
            <form id="register-form" onsubmit="return validateForm()">
                <div class="modal-header ">
                    <h5 class="modal-title d-flex align-items-center" id="loginModalLabel">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i> User Registration
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                        Note: Your details must match with your ID (Aadhar card,password,driving license,etc.)
                        that will be required during the travelling session
                    </span>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Name</label>
                                <input name="name" type="text" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Email</label>
                                <input name="email" type="email" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input name="phonenum" type="tel" pattern="[0-9]{10}" class="form-control shadow-none"
                                    required>
                                <small class="form-text text-muted">Enter a 10-digit phone number.</small>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Picture</label>
                                <input name="profile" type="file" accept=".jpg,.jpeg,.png,.webp"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-12 p-0 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" style="font-size:15px" class="form-control shadow-none "
                                    rows="1" required></textarea>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input name="pass" type="password" class="form-control shadow-none" id="password"
                                        required>
                                    <button type="button" class="shadow-none btn btn-outline-secondary toggle-password"
                                        data-target="password">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <small id="passwordHelp" class="form-text">Must be at least 8 characters, contain
                                    uppercase, lowercase, number, and special character.</small>
                            </div>

                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input name="cpass" type="password" class="form-control shadow-none"
                                        id="confirmPassword" required>
                                    <button type="button" class="shadow-none btn btn-outline-secondary toggle-password"
                                        data-target="confirmPassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <small id="confirmPasswordHelp" class="form-text text-danger"></small>
                            </div>

                            <script>
                                // Wait for the DOM to be fully loaded
                                document.addEventListener("DOMContentLoaded", function () {
                                    document.querySelectorAll(".toggle-password").forEach(button => {
                                        button.addEventListener("click", function () {
                                            const targetId = this.getAttribute("data-target");
                                            const passwordField = document.getElementById(targetId);
                                            const icon = this.querySelector("i");

                                            // Toggle password visibility
                                            if (passwordField.type === "password") {
                                                passwordField.type = "text";
                                                icon.classList.remove("bi-eye");
                                                icon.classList.add("bi-eye-slash");
                                            } else {
                                                passwordField.type = "password";
                                                icon.classList.remove("bi-eye-slash");
                                                icon.classList.add("bi-eye");
                                            }
                                        });
                                    });
                                });
                            </script>



                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark shadow-none my-1">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("register-form");
        const passwordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById("confirmPassword");
        const passwordHelp = document.getElementById("passwordHelp");
        const confirmPasswordHelp = document.getElementById("confirmPasswordHelp");

        passwordInput.addEventListener("input", function () {
            const password = passwordInput.value;
            if (isValidPassword(password)) {
                passwordHelp.textContent = "✅ Strong password!";
                passwordHelp.style.color = "green";
            } else {
                passwordHelp.textContent = "❌ Weak password! Must be 8+ chars with uppercase, lowercase, number, and special character.";
                passwordHelp.style.color = "red";
            }
        });

        confirmPasswordInput.addEventListener("input", function () {
           if (passwordInput.value !== confirmPasswordInput.value) {
                  confirmPasswordHelp.textContent = "❌ Passwords do not match!";
                  confirmPasswordHelp.style.setProperty("color", "red", "important"); 
        } else {
                  confirmPasswordHelp.textContent = "✅ Passwords match!";
                  confirmPasswordHelp.style.setProperty("color", "green", "important"); 
        }

        });

        form.addEventListener("submit", function (event) {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            if (!isValidPassword(password)) {
                alert("❌ Password is too weak! Must be 8+ chars, with uppercase, lowercase, number, and special character.");
                event.preventDefault(); // Prevent form submission
                return false;
            }

            if (password !== confirmPassword) {
                alert("❌ Passwords do not match!");
                event.preventDefault(); // Prevent form submission
                return false;
            }

            return true; // Allow form submission if everything is valid
        });

        function isValidPassword(password) {
            return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password);
        }
    });
</script>


<script>
    function validateForm() {
        const form = document.getElementById('register-form');
        const password = form.pass.value;
        const confirmPassword = form.cpass.value;
        const phoneNumber = form.phonenum.value;

        // Check if passwords match
        if (password !== confirmPassword) {
            alert("danger", "Passwords do not match.");
            return false;
        }

        // Check if phone number is valid
        if (!/^\d{10}$/.test(phoneNumber)) {
            alert("danger", "Please enter a valid 10-digit phone number.");
            return false;
        }

        // If all validations pass
        return true;
    }
</script>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const navbar = document.querySelector('.navbar');
        const isIndexPage = window.location.pathname.endsWith("index.php");

        if (isIndexPage) {
            // Index Page Behavior
            window.addEventListener("scroll", function () {
                if (window.scrollY > 600) { // Adjust scroll threshold as needed
                    navbar.classList.add('navbar-scrolled');
                } else {
                    navbar.classList.remove('navbar-scrolled');
                }
            });
        } else {
            // Other Pages Behavior
            navbar.classList.add('navbar-scrolled'); // Always black
        }
    });
</script>

<div class="modal fade" id="forgotModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="loginModalLabel">
                    <i class="bi bi-person-circle fs-3 me-2"></i> Forgot Password
                </h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="forgot-form" class="needs-validation" novalidate>
                    <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                        A link Will Be Sent To Your Email TO Reset Your Password
                    </span>

                    <div class="mb-4">
                        <label for="emailInput" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control shadow-none" required>
                    </div>

                    <div class="mb-2 text-end">

                        <button type="button" class="btn me-2 shadow-none p-0" data-bs-toggle="modal"
                            data-bs-target="#loginModal" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-dark shadow-none ">SEND LINK</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

</ </body>

</html>