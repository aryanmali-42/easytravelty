<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How EasyTravels.tech Works</title>
    <link rel="stylesheet" href="css/styles.css">

    <?php require('inc/links.php') ?>

    <style>
        :root {
            --primary-color: #f59e0b;
            --secondary-color: #7c3aed;
            --accent-color: #f59e0b;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }

        .header-section {

            background: #eee;
            padding: 6rem 0 4rem;
            clip-path: polygon(0 0, 100% 0, 100% 70%, 0 100%);

        }

        .step-icon1 {
            font-size: 3rem;
            color: #0d6efd !important;
        }

        .card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 15px;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .step-card {
            background: white;
            border: none;
            border-left: 4px solid var(--primary-color);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .step-card:hover {
            transform: translateY(-5px);
            border-left-color: var(--accent-color);
        }

        .step-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.1), transparent);
            transition: 0.5s;
        }

        .step-card:hover::before {
            left: 100%;
        }

        .step-icon {
            font-size: 2.5rem;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: transform 0.3s;
        }

        .step-card:hover .step-icon {
            transform: scale(1.2);
        }

        .faq-accordion .accordion-button {
            font-weight: 600;
            background-color: rgba(37, 99, 235, 0.05);
        }

        .faq-accordion .accordion-button:not(.collapsed) {
            background-color: var(--primary-color);
            color: white;
        }

        .footer-section {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: white;
            padding: 4rem 0 2rem;
            margin-top: 6rem;
        }

        .social-icon {
            font-size: 1.5rem;
            color: white;
            transition: all 0.3s;
        }

        .social-icon:hover {
            color: var(--accent-color);
            transform: translateY(-3px);
        }

        .newsletter-input {
            border-radius: 50px;
            padding: 1.25rem;
            border: 2px solid var(--primary-color);
        }

        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--primary-color);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: all 0.3s;
        }

        .accordion-item,
        .accordion-button {
            font-size: 15px;
        }

        .back-to-top.show {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .header-section {
                clip-path: polygon(0 0, 100% 0, 100% 95%, 0 100%);
                padding: 4rem 0 2rem;
            }
        }
    </style>
</head>
<?php require('inc/header.php') ?>

<body class="" style="background-color:#eee">


    <br><br><!-- Header Section -->
    <header class="header-section">
        <div class="container text-center text-white">
            <h1 class="display-4 fw-bold mb-4 text-dark">Welcome to EasyTravels.tech</h1>
            <p class="lead fs-5 mb-0">Your Journey Begins Here - Seamless Travel Planning & Booking</p>
        </div>
    </header>

    <!-- How It Works Section -->
    <section class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold mb-3">How It Works</h2>
            <p class="text-muted">Simple steps to your perfect adventure</p>
        </div>

        <div class="row g-4">
            <!-- Steps 1-3 -->
            <div class="col-lg-4 col-md-6">
                <div class="step-card p-4 h-100 shadow-sm">
                    <div class="text-center mb-3">
                        <i class="bi bi-person step-icon"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Step 1: Login or Register</h4>
                    <p class="text-muted mb-0">Sign up in seconds using your email to unlock all
                        features.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="step-card p-4 h-100 shadow-sm">
                    <div class="text-center mb-3">
                        <i class="bi bi-search step-icon"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Step 2: Browse & Search Packages</h4>
                    <p class="text-muted mb-0">Explore our wide range of travel packages and use Search filters to find
                        the
                        perfect
                        package.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="step-card p-4 h-100 shadow-sm">
                    <div class="text-center mb-3">
                        <i class="bi bi-cart step-icon"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Step 3: Book Your Package</h4>
                    <p class="text-muted mb-0">Select the number of packages you want and proceed to book.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step-card p-4 h-100 shadow-sm">
                    <div class="text-center mb-3">
                        <i class="bi bi-credit-card-2-front step-icon"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Step 4: Make Payment</h4>
                    <p class="text-muted mb-0">Securely pay for your booking using our trusted payment gateway.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step-card p-4 h-100 shadow-sm">
                    <div class="text-center mb-3">
                        <i class="bi  bi-file-earmark-pdf step-icon"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Step 5: Download Booking PDF</h4>
                    <p class="text-muted mb-0">Download your booking confirmation as a PDF for your records.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step-card p-4 h-100 shadow-sm">
                    <div class="text-center mb-3">
                        <i class="bi bi-list-check step-icon"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Step 6: Manage Your Bookings</h4>
                    <p class="text-muted mb-0">View, cancel, or request a refund for your bookings before the package
                        date.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step-card p-4 h-100 shadow-sm">
                    <div class="text-center mb-3">
                        <i class="bi bi-star step-icon"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Step 8: Leave Reviews</h4>
                    <p class="text-muted mb-0">Share your experience by leaving reviews for the packages you booked.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step-card p-4 h-100 shadow-sm">
                    <div class="text-center mb-3">
                        <i class="bi bi-person-circle step-icon"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Step 9: Contact Admin</h4>
                    <p class="text-muted mb-0">Use the contact us page to reach out to our admin for any inquiries.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step-card p-4 h-100 shadow-sm">
                    <div class="text-center mb-3">
                        <i class="bi bi-bell  step-icon"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Step 10: Receive Notifications</h4>
                    <p class="text-muted mb-0">Stay updated with email notifications after booking your packages.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- FAQ Section -->

    <!-- FAQ Section -->
    <section class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold mb-3">Frequently Asked Questions</h2>
            <p class="text-muted">Quick answers to common questions</p>
        </div>

        <div class="accordion faq-accordion" id="faqAccordion">
            <!-- Existing FAQ Items -->
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        How do I reset my password?
                    </button>
                </h3>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Click 'Forgot Password' on the login page and enter your email , now a verification link on your
                        email will be send , once you clicked on that your account will be verified
                    </div>
                </div>
            </div>

            <!-- New FAQ Items -->
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq2">
                        What is your cancellation policy?
                    </button>
                </h3>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        You can cancel bookings before departure for a full refund.
                    </div>
                </div>
            </div>



            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq4">
                        What documents do I need to travel?
                    </button>
                </h3>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Requirements vary by destination. Generally, you'll need a valid government-issued ID for
                        travel
                    </div>
                </div>
            </div>







            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq8">
                        Are there age restrictions for packages?
                    </button>
                </h3>
                <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        No There are no such age restrictions for packages our packages are designed in such way that
                        everone can enjoy that
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq9">
                        How do I request special accommodations?
                    </button>
                </h3>
                <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Contact our support team at least 72 hours before departure for special requests regarding
                        dietary needs, or other accommodations.
                    </div>
                </div>
            </div>


        </div>
    </section>

    <!-- How It Works Section -->

    <!-- Footer -->


    <div class="back-to-top" id="backToTop">
        <i class="bi bi-arrow-up"></i>
    </div>
    <footer class="text-center text-lg-start bg-body-tertiary text-muted" style="background-color:#eee">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Connect with us on social media:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="#" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="#" class="me-4 text-reset">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links -->
        <section>
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Company Info -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-plane me-3"></i> EasyTravels
                        </h6>
                        <p>
                            EasyTravels is your trusted partner in planning memorable journeys. Explore exciting
                            destinations, premium stays, and seamless travel arrangements with us.
                        </p>
                    </div>
                    <!-- Company Info -->

                    <!-- Services -->
                    <!-- Services -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            How It Works
                        </h6>
                        <p><a href="help.php" class="text-reset"> Your Travel Guide: Step by Step</a></p>

                    </div>

                    <!-- Quick Links -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Quick Links
                        </h6>
                        <p><a href="about.php" class="text-reset">About Us</a></p>
                        <p><a href="contact.php" class="text-reset">Contact</a></p>
                        <p><a href="facilities.php" class="text-reset">Reviews</a></p>

                    </div>
                    <!-- Quick Links -->

                    <!-- Contact -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Contact Us</h6>
                        <p><i class="fas fa-map-marker-alt me-3"></i> Mulund, Mumbai, India</p>
                        <p><i class="fas fa-envelope me-3"></i>mali.aryan423@gmail.com</p>
                        <p><i class="fas fa-phone me-3"></i> 9137632053</p>
                        <p><i class="fas fa-clock me-3"></i> Mon - Sat: 9:00 AM - 6:00 PM</p>
                    </div>
                    <!-- Contact -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links -->
        <hr>
        <!-- Copyright -->
        <div class="text-center p-4" style="background-color:#eee; color: black;">
            © 2024 EasyTravels. All rights reserved.
        </div>
        <!-- Copyright -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Back to top button functionality
        const backToTopButton = document.getElementById('backToTop');
        window.onscroll = function () {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        };

        backToTopButton.onclick = function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };
    </script>
</body>

</html>