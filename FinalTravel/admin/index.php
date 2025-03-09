<?php
require('inc/essentials.php');
require('../connection.php');
session_start();

if (isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true) {
    redirect('dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php require('inc/links.php'); ?>
    <style>
        div.login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="login-container d-flex align-items-center justify-content-center min-vh-100 bg-light">
        <div class="login-form text-center rounded-4 overflow-hidden bg-white shadow-lg"
            style="width: 90%; max-width: 400px;">
            <form method="POST" class="px-3">
                <div class="header bg-primary-gradient py-4">
                    <i class="fas fa-user-shield fa-3x text-white mb-3"></i>
                    <h2 class="text-dark mb-0 fw-bold">Admin Portal</h2>
                </div>

                <div class="p-4 px-5">
                    <div class="mb-4">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="fas fa-user text-primary"></i>
                            </span>
                            <input type="text" class="form-control rounded-start shadow-none ps-3" name="admin_name"
                                required placeholder="Admin Name">
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="fas fa-lock text-primary"></i>
                            </span>
                            <input type="password" class="form-control rounded-start shadow-none ps-3" name="admin_pass"
                                required placeholder="Password">
                        </div>
                    </div>

                    <button name="login" type="submit"
                        class="btn btn-primary w-100 py-2 fw-bold rounded-pill hover-effect">
                        Sign In
                        <i class="fas fa-arrow-right ms-2"></i>
                    </button>

                </div>
            </form>
        </div>
    </div>

    <style>
        .primary-gradient {
            background: linear-gradient(135deg, #3b82f6, #6366f1);
        }

        .hover-effect {
            transition: all 0.3s ease;
        }

        .hover-effect:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
            border-color: #3b82f6;
        }

        .login-form {
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .input-group-text {
            border-right: 0 !important;
            border-color: #dee2e6;
        }

        .form-control {
            border-left: 0 !important;
        }
    </style>
    <?php
    if (isset($_POST['login'])) {
        $frm_data = filteration($_POST);
        $query = "SELECT * FROM `admin_cred` WHERE    `admin_name`=? AND `admin_pass`=? "; //prepared statement
        $values = [$frm_data['admin_name'], $frm_data['admin_pass']];
        $datatypes = "ss";
        $res = select($query, $values, "ss");
        if ($res->num_rows == 1) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminId'] = $row['sr_no'];
            redirect('dashboard.php');
        } else {
            alert('error', 'Login Failed - Invalid Credentials');
        }
    }
    ?>
    <?php require('inc/scripts.php'); ?>
</body>

</html>