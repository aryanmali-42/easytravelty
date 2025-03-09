<!-- Footer -->

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
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        How It Works
                    </h6>
                    <p><a href="help.php" class="text-reset"> Your Travel Guide: Step by Step</a></p>

                </div>
                <!-- Services -->

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

<!-- Footer -->

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

<!-- SwiperJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Scroll REVEAL -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/4.0.9/scrollreveal.min.js"></script>
<!-- sliderJs -->
<script src="js/slider.js"></script>
<!-- IndexJs -->
<script src="js/index.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

<!-- fontawosome -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
<script>

    function alert(type, msg, position = 'body') {
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = ` <div class="alert ${bs_class} ">
            <strong class="me-3">${msg}!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> `;
        if (position == 'body') {
            document.body.append(element);

            element.classList.add('custom-alert');
        } else {
            document.getElementById(position).appendChild(element);
        }
        setTimeout(remAlert, 2000)
    }
    function remAlert() {
        document.getElementsByClassName('alert')[0].remove();
    }

    let register_form = document.getElementById('register-form');
    register_form.addEventListener('submit', function (e) {
        e.preventDefault();
        let data = new FormData();
        data.append('name', register_form.elements['name'].value);
        data.append('email', register_form.elements['email'].value);
        data.append('phonenum', register_form.elements['phonenum'].value);
        data.append('address', register_form.elements['address'].value);
        data.append('pass', register_form.elements['pass'].value);
        data.append('cpass', register_form.elements['cpass'].value);
        data.append('profile', register_form.elements['profile'].files[0]);//pheile file janar
        data.append('register', '');

        var myModal = document.getElementById('registerModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

          xhr.onload = function () {
            if (this.responseText == 'pass_mismatch') {
                alert('error', "Password Mismatched !!");
            }
            else if (this.responseText == 'email_already') {
                alert('error', "Email Is Already Registered !!");
            } else if (this.responseText == 'phone_already') {
                alert('error', "Phone Number Is Already Registered !!");
            }
            else if (this.responseText == 'inv_img') {
                alert('error', "Only JPG,WEBP & PNG images are allowed !!");
            } else if (this.responseText == 'pass_weak') {
                alert('error', "Your Password Is Weak");
            } else if (this.responseText == 'pass_short') {
                alert('error', "Your Password Is short");
            }
            else if (this.responseText == 'upd_failed') {
                alert('error', "Upload image failed !!!");
            }
            else if (this.responseText == 'ins_failed') {
                alert('error', "Registeriation failed !!");
            }
            else {
                alert('success', "Registration Successfully Confirmation Link Send To Mail !");
                register_form.reset();
            }

        }
        xhr.send(data);
    });

    let login_form = document.getElementById('login-form');
    login_form.addEventListener('submit', function (e) {
        e.preventDefault();
        let data = new FormData();
        data.append('email_mob', login_form.elements['email_mob'].value);
        data.append('pass', login_form.elements['pass'].value);
        data.append('login', '');

        var myModal = document.getElementById('loginModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);
        xhr.onload = function () {
            if (this.responseText == 'inv_email_mob') {
                alert('error', "Invalid Email Or Mobile Number !!");
            } else if (this.responseText == 'inactive') {
                alert('error', "Account Suspended ! Please Contact Admin !!");
            } else if (this.responseText == 'not_verified') {
                alert('error', "Email Is Not Verified!");
            }
            else if (this.responseText == 'invalid_pass') {
                alert('error', "Wrong Password !!");
            }
            else {

                window.location = window.location.pathname;

                //split function array ke form pe split kerta hai keyworrd ke hisab se
                //pop last  ko pop karega 
                //shift array ka 1st function nikal ke deta hai
            }

        }
        xhr.send(data);
    });

    let forgot_form = document.getElementById('forgot-form');
    forgot_form.addEventListener('submit', function (e) {
        e.preventDefault();
        let data = new FormData();
        data.append('email', forgot_form.elements['email'].value);
        data.append('forgot_pass', '');

        var myModal = document.getElementById('forgotModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);
        xhr.onload = function () {
            if (this.responseText == 'inv_email') {
                alert('error', "Invalid Email  !!");
            } else if (this.responseText == 'inactive') {
                alert('error', "Account Suspended ! Please Contact Admin !!");
            } else if (this.responseText == 'not_verified') {
                alert('error', "Email Is Not Verified! Contact Admin");
            }
            else if (this.responseText == 'mail_failed') {
                alert('error', "Cannto send email !!");
            } else if (this.responseText == 'upd_failed') {
                alert('error', "Password Reset Failed !!");
            }
            else {
                alert('success', "Reset Password Link Send To Mail!");
                forgot_form.reset();
            }
        }
        xhr.send(data);
    });


</script>