<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About US</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/common.css">
    <?php require('inc/links.php') ?>
    <style>
        .box {
            border-top: 4px solid var(--primary) !important;

        }

        .hero-title {
            font-size: 2.8rem;
            background: linear-gradient(45deg, var(--primary), #1e40af);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .feature-card {
            transition: all 0.3s ease;
            border-top: 4px solid var(--primary);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .team-member {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .team-member img {
            transition: all 0.3s ease;
        }

        .team-member:hover img {
            transform: scale(1.05);
        }

        .team-member h5 {
            background: rgba(255, 255, 255, 0.9);
            padding: 1rem;
            margin: 0;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            transform: translateY(100%);
            transition: all 0.3s ease;
        }

        .team-member:hover h5 {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .feature-card {
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>

<body class="bg-light">
    <?php include('inc/header.php'); ?>
    <br><br><br>
    <div class="my-5 px-4 facilities">
        <h2 class="fw-bold h-font text-center">ABOUT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Welcome to <strong>EasyTravels</strong> – your trusted travel companion! We specialize in crafting
            unforgettable travel experiences,<br>
            offering customized tour packages, hotel bookings, and seamless travel arrangements. <br>Whether it's a solo
            trip, family vacation,
            or corporate getaway, we ensure hassle-free planning and execution.
        </p>
    </div>
    <div class="whychooseus container">
        <div class="row justify-content-between align-items-center">
            <div class="whychooseustext col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">Why Choose Us?</h3>
                <p>
                    At <strong>EasyTravels</strong>, we prioritize customer satisfaction by offering:
                <ul>
                    <li>✅ Handpicked travel destinations with the best deals</li>
                    <li>✅ Hassle-free Package Booking</li>
                    <li>✅ 24/7 customer support to assist you</li>
                    <li>✅ Secure and easy online transactions</li>
                </ul>
                With years of experience in the travel industry, we are committed to making your journey smooth,
                exciting, and memorable!
                </p>
            </div>
            <div class="whychooseusimage col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
                <img src="./images/about.jpg" alt="About EasyTravels" class="w-100">
            </div>
        </div>
    </div>

    <div class="servicess container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="./images/hotel.svg" style=" width:70px; height:90px;">
                    <h4 class="mt-3">BEST CUSTOMER SERVICE</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="./images/user.svg" style=" width:70px; height:90px;">
                    <h4 class="mt-3">200+ CUSTOMERS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="./images/tours.svg" style=" width:70px; height:90px;">
                    <h4 class="mt-3">BEST PACKAGE</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="./images/hygien.svg" style=" width:70px; height:90px;">
                    <h4 class="mt-3">EVERYTHING HYGINE</h4>
                </div>
            </div>

        </div>
    </div>

    <h2 class="my-5 fw-bold h-font text-center" style="font-size:40px">MANAGEMENT TEAM</h2>

    <div class="container px-4">

        <div class="swiper mySwiper">
            <div class="swiper-wrapper mb-5">
                <?php
                $about_r = selectAll('team_details');
                $path = ABOUT_IMG_PATH;
                while ($row = mysqli_fetch_assoc($about_r)) {
                    echo <<<data
                    <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                        <img src="$path$row[picture]" alt="" class="w-100" style="height:250px ; width:250px">
                       <h5 class="mt-2">$row[name]</h5>
                    </div>
                    
                    data;
                }
                ?>


                <div class="swiper-pagination " style="margin-bottom:-40px "></div>

            </div>
        </div>

        <br><br><br><br><br>
        <!-- Swiper JS -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                el: ".swiper-pagination",
            },
        });

    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const scroll = ScrollReveal({
                distance: '50px', // Distance the element moves on scroll
                duration: 1000, // Duration of the animation
                easing: 'ease-in-out', // Easing function for smoothness
                reset: true, // Reset animations when scrolling up
            });

            // Reveal the .whychooseustext with animation from the left
            scroll.reveal('.whychooseus .whychooseustext', {
                origin: 'left',

            });

            // Reveal the .whychooseusimage with animation from the left
            scroll.reveal('.whychooseus .whychooseusimage', {
                origin: 'right',

            });

            scroll.reveal('.servicess ', {
                origin: 'top', delay: 300,
            });
        });
    </script>

    <?php include('inc/footer.php') ?>


</body>

</html>