<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=1, initial-scale=1.0">
  <title>EasyTravel-Home</title>
  <link rel="stylesheet" href="css/styles.css">

  <?php require('inc/links.php') ?>
</head>

<body>
  <?php require('inc/header.php') ?>

  <!-- MAIN SLIDER -->
  <header class="header" id="header">
    <!-- NAV BAR  -->
    <div class="swiper slider-1">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="./images/pic-1.jpg" alt="">
        </div>
        <div class="swiper-slide">
          <img src="./images/pic-2.jpg" alt="">
        </div>
        <div class="swiper-slide">
          <img src="./images/pic-4.jpg" alt="">
        </div>
        <div class="swiper-slide">
          <img src="./images/pic-5.jpg" alt="">
        </div>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>

    </div>
    <!-- CONTECNT MID TEXT -->
    <div class="content">
      <h1>
        <br> Let's explore the
        India
        together!
      </h1>
      <a href="package.php" class="btn">Get Started</a>
    </div>
  </header>

  <!-- BASIC INFO -->
  <main class="main" style="background-color:#eee">

    <!-- BASIC INFO -->
    <section class="section info">
      <div class="container">
        <div class="row d-flex">
          <div class="col-md-6 order-md-last heading-section pl-md-5 ">
            <h2 class="mb-5">It's Time to Start Your Adventure</h2>
            <p class="text-secondary">
              Embark on an unforgettable journey with EasyTravels. Whether you're looking for a relaxing getaway, a
              thrilling adventure, or a cultural experience, we have the perfect travel packages tailored just for you.
            </p>
            <p class="text-secondary">
              Explore breathtaking destinations, enjoy seamless travel arrangements, and experience the world like never
              before. With expert guides, curated itineraries, and premium facilities, your dream vacation is just a
              click away.
            </p>
            <p><a href="package.php" class="btn btn-primary py-3 px-4">Search Destination</a></p>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6 d-flex align-self-stretch">
                <div class="media block-6 services d-block">
                  <div class="icon"><span class="flaticon-paragliding"></span></div>
                  <div class="media-body">
                    <h3 class="heading text-dark mb-3">Exciting Activities</h3>
                    <p class="text-secondary">
                      From paragliding and scuba diving to city tours and wildlife safaris, our packages offer thrilling
                      experiences for every traveler.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services d-block">
                  <div class="icon"><span class="flaticon-route"></span></div>
                  <div class="media-body">
                    <h3 class="heading mb-3">Hassle-Free Travel Arrangements</h3>
                    <p class="text-secondary">
                      We handle everything—from flights and hotel bookings to local transport—so you can enjoy a
                      stress-free travel experience.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services d-block">
                  <div class="icon"><span class="flaticon-tour-guide"></span></div>
                  <div class="media-body">
                    <h3 class="heading mb-3">Expert Tour Guides</h3>
                    <p class="text-secondary">
                      Discover the hidden gems of every destination with our experienced local guides who ensure an
                      enriching and safe journey.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services d-block">
                  <div class="icon"><span class="flaticon-map"></span></div>
                  <div class="media-body">
                    <h3 class="heading mb-3">Location Manager</h3>
                    <p class="text-secondary">
                      Our dedicated location managers ensure smooth travel experiences, handling logistics and making
                      your journey hassle-free.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- ABOUT US-->
    <section class="section about" id="about">
      <div class="container">
        <div class="row align-items-center">
          <!-- Text Section -->
          <div class="col-md-6 order-md-2 heading-section pl-md-5 anima">
            <div class="title">
              <h1 class="h-font">About Us</h1>
            </div>
            <p> <?php
            // Fetch the 'site_about' content from the 'settings' table
            $result = selectAll('settings');
            if ($result->num_rows > 0) {
              // Fetch the row and display the 'site_about' content
              $row = $result->fetch_assoc();
              echo nl2br(htmlspecialchars($row['site_about']));
            } else {
              echo "No content available for About Us.";
            }
            ?></p>
            <a href="about.php" class="btn btn-primary">Know More</a>
          </div>

          <!-- Image Slider Section -->
          <div class="col-md-6 order-md-1 anima1">
            <div class="swiper slider-2">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <img src="./images/pic-2.jpg" alt="Image 3" class="img-fluid">
                </div>
                <div class="swiper-slide">
                  <img src="./images/pic-1.jpg" alt="Image 4" class="img-fluid">
                </div>
                <div class="swiper-slide">
                  <img src="./images/pic-2.jpg" alt="Image 5" class="img-fluid">
                </div>
                <div class="swiper-slide">
                  <img src="./images/pic-1.jpg" alt="Image 6" class="img-fluid">
                </div>
              </div>
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- TRIP SLIDER TRIP WITH US-->
    <section class="section trip" id="trip">
      <div class="title">
        <h1 class="h-font">
          Plan Your <br />
          Trip With Us
        </h1>
        <p>
          Discover hassle-free travel with EasyTravels! Enjoy curated packages, comfortable stays, guided tours, and
          seamless travel arrangements for an unforgettable journey. ✈️🌍🚗

        </p>
      </div>
      <div class="row container">
        <div class="swiper slider-3">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <img src="./images/vert-3.jpg" alt="">
            </div>
            <div class="swiper-slide">
              <img
                src="https://img.freepik.com/free-photo/beautiful-vertical-shot-taj-mahal-building-agra-india-cloudy-sky_181624-16913.jpg?t=st=1738693046~exp=1738696646~hmac=d4ca26098cb39f858499d81808d9d4acce155f3eb874d2b39b6d18162d871565&w=740"
                alt="">
            </div>
            <div class="swiper-slide">
              <img
                src="https://img.freepik.com/free-photo/watch-tower-el-morro-castle-old-san-juan-puerto-rico_649448-2758.jpg?t=st=1738693013~exp=1738696613~hmac=6aa8f3a29ca8c9e353b60a0d43e5aaa8c22e210f019020710ec365e8434b0a84&w=740"
                alt="">
            </div>
            <div class="swiper-slide">
              <img
                src="https://img.freepik.com/free-photo/mehrangarh-fort-jodhpur-rajasthan-india_1357-11.jpg?t=st=1738692970~exp=1738696570~hmac=5f92cb01b17ead5f8e8ef38e094d0f7e36828f9f0864c537388e55ca7093f175&w=740"
                alt="">
            </div>
            <div class="swiper-slide">
              <img
                src="https://img.freepik.com/free-photo/gray-concrete-dome_413556-25.jpg?t=st=1738692947~exp=1738696547~hmac=836435fca7ba563eaa0d09d8c6a691ddaaefcf1f58772e6ac6eadcd3954ffa3d&w=740"
                alt="">
            </div>
            <div class="swiper-slide">
              <img
                src="https://img.freepik.com/free-photo/indian-city-buildings-scene_23-2151823128.jpg?t=st=1738693169~exp=1738696769~hmac=d2606492ffdf67f81d488531d3a68a1c44e562d67361ea29939c4de21d115998&w=740"
                alt="">
            </div>
            <div class="swiper-slide">
              <img
                src="https://img.freepik.com/free-photo/street-old-valletta_1398-179.jpg?t=st=1738692836~exp=1738696436~hmac=ae42ba4e6f182f744e77e00a59cf50493b7fc542fdb842ceba92903ae50d2bc8&w=740"
                alt="">
            </div>

          </div>
          <div class="custom-next  d-flex "></div>
          <!-- #swiper-button-next -->
          <div class="custom-prev  d-flex  "></div>
          <!-- swiper-button-prev -->
          <!-- sswiper-pagination -->

        </div>
        <div class="custom-pagination "></div>

      </div>
      <div class="explore">
        <a href="package.php" class="btn">Explore All</a>
      </div>

    </section>
    <!-- OUR PAckage -->
    <div class="title text-center">
      <h1 class="h-font">
        OUR PACKAGES </h1>

    </div>
    <div class="container ourroom">
      <div class="row">
        <?php
        $package_res = select("SELECT * FROM `packages` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC  LIMIT 3", [1, 0], 'ii');
        while ($package_data = mysqli_fetch_assoc($package_res)) {
          //get features from package 
          // inner join use krto
          $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `package_features` pfea ON f.id = pfea.features_id WHERE pfea.package_id='$package_data[id]'");
          $features_data = "";
          while ($fea_row = mysqli_fetch_assoc($fea_q)) {
            $features_data .= "   <span class='badge rounded-pill bg-light text-dark  text-wrap  me-1 mb-1'>
                                 $fea_row[name]
                                </span>";
          }
          //get facilities from package 
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
            $book_btn = "<div class='d-grid'> <a href='package_details.php?id=$package_data[id]' class='btn btn-primary btn-lg  shadow-none' >Book Now</a> </div>";
          }


          $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review`
          WHERE `package_id` = '$package_data[id]' ORDER BY `sr_no` DESC LIMIT 20";
          $rating_res = mysqli_query($con, $rating_q);

          $rating_fetch = mysqli_fetch_assoc($rating_res);
          $rating_data = "";
          if ($rating_fetch['avg_rating'] != NULL) {
            $rating_data = " <div class='rating mb-4'>
                              <h5 class='mb-1 font-weight-bold'>Ratings</h5>
                              <span class='badge rounded-pill bg-light text-dark'>
                                <span class='badge rounded-pill bg-light'>";

            for ($i = 0; $i < $rating_fetch['avg_rating']; $i++) {

              $rating_data .= "<i class='fa-solid fa-star text-warning ' style='font-size:15px;'></i>";
            }
            $rating_data .= "    </span></span>
                          </div>";
          }
          $start_date = $package_data['date']; // Start date from your database
          $duration = $package_data['duration']; // Duration in days from the database
        
          // Convert start date to a timestamp
          $start_timestamp = strtotime($start_date);

          // Add duration (in days) to the start date
          $end_timestamp = strtotime("+$duration days", $start_timestamp);

          // Convert the end timestamp back to a date format
          $start_date1 = date('d-m-Y', $start_timestamp);
          $end_date1 = date('d-m-Y', $end_timestamp);

          //printing package card
          echo <<<data
          <div class="col-lg-4 col-md-6 package-card mb-4" data-name="$package_data[name]">
                <div class="cardhome card h-100 shadow-sm border-0 hover-scale">
                    <div class="position-relative">
                    <img src="$package_thumb" 
                          class="card-img-top" 
                          style="height: 200px; object-fit: cover; border-top-left-radius: 15px; border-top-right-radius: 15px;">
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

            <style>
            .hover-scale {
                transition: transform 0.3s ease;
            }
            .hover-scale:hover {
                transform: translateY(-5px);
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
            .ribbon {
            width: 100px;
            height: 100px;
            overflow: hidden;
            position: absolute;
            }
            .ribbon::before,
            .ribbon::after {
            position: absolute;
            z-index: -1;
            content: '';
            display: block;
            border: 5px solid #ffd700;
            }
            .ribbon span {
            position: absolute;
            display: block;
            width: 150px;
            padding: 8px 0;
            background-color: #ffd700;
            box-shadow: 0 5px 10px rgba(0,0,0,.1);
            color: #333;
            font-weight: bold;
            text-align: center;
            left: -25px;
            top: 15px;
            transform: rotate(-45deg);
            }
            </style>

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
        data;
        }
        ?>

        <div class="col-lg-12 text-center mt-5">
          <a href="package.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Tours >>></a>

        </div>
      </div>
    </div>
    <br> <br> <br> <br>
    <!-- OUR FACILITIES -->
    <div class="title text-center">
      <h1 class="h-font">
        OUR SERIVICES
      </h1>

    </div>
    <div class="container facilities">
      <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
        <?php
        $res = mysqli_query($con, "SELECT * FROM `facilities` ORDER BY `id` DESC  LIMIT 5");
        $path = FACILITIES_IMG_PATH;
        while ($row = mysqli_fetch_assoc($res)) {
          echo <<<data
              <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
               <img src="$path$row[icon]" width="80px" style="width:90px;  margin-top:-15px">
                  <h5 class="mt-3">$row[name]</h5>
             </div>
          data;
        }
        ?>

      </div>
    </div>

    <!-- DISCOUNT SECTION -->
    <section class="section discount">
      <div class="overlay">
        <video class="video">
          <source src="https://videos.pexels.com/video-files/12628503/12628503-uhd_2560_1440_60fps.mp4"
            type="video/mp4" />


        </video>
      </div>
      <div class="content">
        <h1>
          Get 15% Off on <br />
          Next Travel
        </h1>
        <a href="package.php" class="btn">Explore The Tour</a>
        <span class="video-control d-flex">
          <i class="bx bx-play"></i>
        </span>
      </div>
    </section>




  </main>
  <!-- PASWORD RESET MODAL -->
  <div class="modal fade" id="recoveryModel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog rounded fw-bold">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h5 class="modal-title" id="loginModalLabel">
            <i class="bi bi-shield-lock fs-3 me-2"></i> SetUp New Password
          </h5>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="recover-form" class="needs-validation" novalidate>

            <div class="mb-4">
              <label for="emailInput" class="form-label">New Password</label>
              <input type="password" name="pass" class="form-control shadow-none" required>
              <input type="hidden" name="email">
              <input type="hidden" name="token">
            </div>

            <div class="mb-2 text-end">

              <button type="button" class="btn me-2 shadow-none " data-bs-dismiss="modal">
                Cancel
              </button>
              <button type="submit" class="btn btn-dark shadow-none ">Submit</button>

            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
  <?php require('inc/footer.php') ?>

  <?php
  if (isset($_GET['account_recovery'])) {
    $data = filteration($_GET);
    $t_date = date("Y-m-d");
    $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1", [$data['email'], $data['token'], $t_date], 'sss');
    if (mysqli_num_rows($query) == 1) {
      echo <<<showModal
          <script>
        
              var myModal = document.getElementById('recoveryModel');
              myModal.querySelector("input[name='email']").value='$data[email]';
              myModal.querySelector("input[name='token']").value='$data[token]';



              var modal = bootstrap.Modal.getOrCreateInstance(myModal);
              modal.show();
          </script>
      showModal;

    } else {
      alert('error', 'Invalid or Expired Link');
    }
  }
  ?>
  <!-- //recover account -->
  <script>
    let recover_form = document.getElementById('recover-form');
    recover_form.addEventListener('submit', function (e) {
      e.preventDefault();
      let data = new FormData();
      data.append('email', recover_form.elements['email'].value);
      data.append('token', recover_form.elements['token'].value);
      data.append('pass', recover_form.elements['pass'].value);
      data.append('recover_user', '');

      var myModal = document.getElementById('recoveryModel');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/login_register.php", true);
      xhr.onload = function () {
        if (this.responseText == 'failed') {
          alert('error', 'Account Reset Failed');
        }
        else {
          alert('success', 'Account Reset Successful');
          recover_form.reset();
        }
      }
      xhr.send(data);
    });



  </script>

</body>

</html>