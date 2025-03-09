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
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin-bottom: 2rem;
            padding: 2rem;
        }

        .profile-card:hover {
            transform: translateY(-5px);
        }

        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 0 auto 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #4a5568;
            box-shadow: none;
        }

        .btn-custom {
            background: #ffc400;
            color: black;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            border: none;
            transition: transform 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            color: white;
        }

        .input-group-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            z-index: 4;
        }

        .file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
            height: 100%;
            width: 100%;
        }

        .section-title {
            color: #4a5568;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            font-weight: 700;
        }
    </style>
</head>
<?php
include('inc/header.php');

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}
$u_exists = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 's');
if (mysqli_num_rows($u_exists) == 0) {
    redirect('index.php');
}
$u_fetch = mysqli_fetch_assoc($u_exists);


?>

<body class="bg-light" style="background-color:#eee">

    <br><br><br>
    <div class="profile-container">
        <!-- Basic Information Section -->
        <div class="profile-card">
            <h3 class="section-title"><i class="fas fa-user-circle me-2"></i>Basic Information</h3>
            <form id="info-form">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="position-relative">
                            <i class="fas fa-user input-group-icon"></i>
                            <input name="name" type="text" class="form-control ps-5"
                                value="<?php echo $u_fetch['name'] ?>" placeholder="Full Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative">
                            <i class="fas fa-phone input-group-icon"></i>
                            <input name="phonenum" type="number" class="form-control ps-5"
                                value="<?php echo $u_fetch['phonenum'] ?>" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="position-relative">
                            <i class="fas fa-envelope input-group-icon"></i>
                            <input name="email" type="email" class="form-control ps-5"
                                value="<?php echo $u_fetch['email'] ?>" readonly>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="position-relative">
                            <i class="fas fa-map-marker-alt input-group-icon"></i>
                            <textarea name="address" class="form-control ps-5" rows="3"
                                placeholder="Address"><?php echo $u_fetch['address'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-custom">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row g-8">
            <!-- Profile Picture Section -->
            <div class="col-lg-12">
                <div class="profile-card text-center">
                    <h3 class="section-title"><i class="fas fa-camera me-2"></i>Profile Picture</h3>
                    <img src="<?php echo USERS_IMG_PATH . $u_fetch['profile'] ?>" class="profile-img"
                        alt="Profile Picture">
                    <form id="profile-form">
                        <div class="file-upload btn btn-custom position-relative mt-3">
                            <span><i class="fas fa-upload me-2"></i>Choose File</span>
                            <input name="profile" type="file" class="file-upload-input" accept=".jpg,.jpeg,.png,.webp">
                        </div>
                        <button type="submit" class="btn btn-custom mt-3">
                            <i class="fas fa-sync-alt me-2"></i>Update Image
                        </button>
                    </form>
                </div>
            </div>

            <!-- Password Change Section -->
          
            </div>
        </div>
    </div>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- Bootstrap JS Bundle -->


    <?php include('inc/footer.php'); ?>
    <script>
        let info_form = document.getElementById('info-form');
        info_form.addEventListener('submit', function (e) {
            e.preventDefault();
            let data = new FormData();
            data.append('info_form', '');
            data.append('name', info_form.elements['name'].value);
            data.append('phonenum', info_form.elements['phonenum'].value);
            data.append('address', info_form.elements['address'].value);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/profile.php", true);
            xhr.onload = function () {
                if (this.responseText == 'phone_already') {

                    alert('error', "Phone Number Is Already Registered !!");

                }
                else if (this.responseText == 0) {
                    alert('error', 'no changes made');
                }
                else {
                    alert('success', 'Profile Updated Successfully');
                }
            }
            xhr.send(data);

        });

        let profile_form = document.getElementById('profile-form');

        profile_form.addEventListener('submit', function (e) {
            e.preventDefault();
            let data = new FormData();
            data.append('profile_form', '');
            data.append('profile', profile_form.elements['profile'].files[0]);// pheile file


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/profile.php", true);
            xhr.onload = function () {

                if (this.responseText == 'inv_img') {
                    alert('error', "Only JPG,WEBP & PNG images are allowed !!");
                }
                else if (this.responseText == 'upd_failed') {
                    alert('error', "Upload image failed !!");
                }
                else if (this.responseText == 0) {
                    alert('error', 'Profile Not updated !!');
                }
                else {
                    window.location.href = window.location.pathname;
                }
            }
            xhr.send(data);

        });

        let pass_form = document.getElementById('pass-form');

        pass_form.addEventListener('submit', function (e) {
            e.preventDefault();

            let new_pass = pass_form.elements['new_pass'].value;
            let confirm_pass = pass_form.elements['confirm_pass'].value;

            if (new_pass != confirm_pass) {
                alert('error', "Passwords do not match !!");
                return false;
            }


            let data = new FormData();
            data.append('pass_form', '');
            data.append('new_pass', new_pass);// pheile file
            data.append('confirm_pass', confirm_pass);// pheile file


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/profile.php", true);
            xhr.onload = function () {

                if (this.responseText == 'mismatch') {
                    alert('error', "Password Do Not Match");
                }
                else if (this.responseText == 0) {
                    alert('error', 'Updation Failed !!');
                }
                else {
                    alert('success', 'Password Updated Successfully');
                }
            }
            xhr.send(data);

        });

    </script>
</body>

</html>