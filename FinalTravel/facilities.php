<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratings And Review</title>
    <link rel="stylesheet" href="css/styles.css">
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css">
    <style>
        .facilities p {
            max-width: 600px;
            margin: 0 auto;
            font-size: 1.1rem;
            color: #555;
        }

        .swiper-slide {
            transition: transform 0.3s ease-in-out;
            background: white;
            border-radius: 15px;
            padding: 20px;
            color: white;
        }

        .swiper-slide:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .profile img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 10px;
        }

        .profile h6 {
            font-size: 0.9rem;
            margin: 0;
            color: #333;
        }

        .rating i {
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .swiper-slide {
                padding: 15px;
            }
        }
    </style>
</head>

<body class="bg-light">
    <?php include('inc/header.php'); ?>
    <br><br><br>
    <section class="my-5 px-4 facilities text-center">
        <h2 class="fw-bold h-font">Reviews</h2>
        <div class="h-line bg-dark mx-auto"></div>
        <p class="mt-3"> Hear from our happy customers about their amazing experiences with <strong>EasyTravels</strong></p>
    </section>

    <section class="testimonials py-5">
        <div class="container">
            <h2 class="fw-bold text-center">What Our Clients Say</h2>
            <div class="swiper testimonialSwiper mt-4">
                <div class="swiper-wrapper">
                    <?php
                    $review_q = "SELECT rr.*, uc.name AS uname, uc.profile, p.name AS pname FROM `rating_review` rr 
                                INNER JOIN `user_cred` uc ON rr.user_id=uc.id
                                INNER JOIN `packages` p ON rr.package_id=p.id
                                ORDER BY `sr_no` DESC LIMIT 6";
                    $review_res = mysqli_query($con, $review_q);
                    $img_path = USERS_IMG_PATH;
                    if (mysqli_num_rows($review_res) == 0) {
                        echo "<p class='text-center'>No reviews found.</p>";
                    } else {
                        while ($row = mysqli_fetch_assoc($review_res)) {
                            $stars = "<i class='bi bi-star-fill text-warning '></i>";
                            for ($i = 0; $i < $row['rating']; $i++) {
                                $stars .= "<i class='bi bi-star-fill text-warning '></i>";
                            }

                            echo <<<slides
                            
                            <div class="swiper-slide">
                                <div class="profile d-flex align-items-center mb-3">
                                    <img src="$img_path$row[profile]" loading="lazy" class="rounded-circle">
                                    <h6>$row[uname]</h6>
                                </div>
                                <p class="text-muted">$row[review]</p>
                                <div class="rating">$stars</div>
                            </div>
                            slides;
                        }
                    }
                    ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.testimonialSwiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 20,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'coverflow',
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3,
                }
            }
        });
    </script>

    <?php include('inc/footer.php'); ?>
</body>

</html>