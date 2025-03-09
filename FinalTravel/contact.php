<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTACT-US</title>
    <link rel="stylesheet" href="css/styles.css">

    <?php require('inc/links.php') ?>
    <style>
        h5 {
            font-size: 20px;
        }
    </style>
</head>
<?php include('inc/header.php'); ?>

<body class="" style="background-color:#eee">


    <br><br><br>
    <div class="my-5 px-4 facilities">
        <h2 class="fw-bold h-font text-center">CONTACT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            <a href="help.php " class="text-decoration-none text-dark">Click For Your Travel Guide: Step by Step</a>
        </p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6  px-4">
                <div class="bg-white rounded shadow p-4 ">
                    <iframe class="w-100 rounded mb-4" height="320px"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30151.633169312965!2d72.94461492399338!3d19.15348435227534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b8edba39322f%3A0x80da2c634844abaf!2sMulund%20East%2C%20Mumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1735237234580!5m2!1sen!2sin"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <h5>Address</h5>
                    <a href="https://maps.app.goo.gl/yq13kToyZvGj91Pc6" target="_blank"
                        class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="fa-solid fa-location-dot"></i> ARYAN MALI, MULUND
                    </a>
                    <h5 class="mt-4">Call us</h5>
                    <a href="tel: +9137632053" class="d-inline-block text-decoration-none text-dark">
                        <i class="fa-solid fa-phone"></i>+9137632053
                    </a>
                    <br>
                    <a href="tel: +9137632053" class="d-inline-block text-decoration-none text-dark">
                        <i class="fa-solid fa-phone"></i>+9137632053
                    </a>
                    <h5 class="mt-4">Email
                    </h5>
                    <a href="mailto: aryanmali440@gmail.com" class="d-inline-block text-decoration-none text-dark"><i
                            class="fa-solid fa-envelope"></i>aryanmali440@gmail.com</a>
                    <br>
                    <h5>Follow us</h5>
                    <a href="#" class="d-inline-block mb-3 text-dark fs-3 mb-2">
                        <i class="fa-brands fa-facebook me-1"></i>

                    </a>
                    <a href="#" class="d-inline-block mb-3  text-dark fs-3 mb-2">
                        <i class="fa-brands fa-twitter me-1"></i>
                    </a>
                    <a href="#" class="d-inline-block mb-3  text-dark fs-3 ">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>

            </div>
            <div class="col-lg-6 col-md-6  px-4">
                <div class="bg-white rounded shadow p-4">
                    <form method="POST">
                        <h5>Send A Message</h5>
                        <div class="mt-3">
                            <label for="name" class="form-label" style="font-weight:500;">Name</label>
                            <input type="text" name="name" style="padding-bottom:15px; font-size:15px"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="mt-3">
                            <label for="name" class="form-label" style="font-weight:500;">Email</label>
                            <input type="email" name="email" style="padding-bottom:15px; font-size:15px"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="mt-3">
                            <label for="name" class="form-label" style="font-weight:500;">Subject</label>
                            <input type="text" name="subject" style="padding-bottom:15px; font-size:15px"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="mt-3">
                            <label for="name" class="form-label" style="font-weight:500; ">Message</label>
                            <textarea class="form-control shadow-none" name="message" rows="5"
                                style="resize:none;font-size:15px"></textarea>
                        </div>
                        <button type="submit" name="send" class="btn text-white custom-bg mt-3">Send</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>

    <?php
    if (isset($_POST['send'])) {
        $frm_data = filteration($_POST);
        $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
        $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];
        $res = insert($q, $values, 'ssss');
        if ($res = 1) {
            alert('success', 'Message sent');
        } else {
            alert('error', 'Failed to send message');
        }
    }

    ?>
    <?php include('inc/footer.php'); ?>
</body>

</html>