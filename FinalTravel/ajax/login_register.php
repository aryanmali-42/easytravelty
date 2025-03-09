<?php
require('../connection.php');
require('../admin/inc/essentials.php');
require("../inc/sendgrid-php/sendgrid-php.php");

date_default_timezone_set("Asia/Kolkata");
function send_mail($uemail, $name, $token, $type)
{
    if ($type == "email_confirmation") {
        $page = 'email_confirm.php';
        $subject = "Complete Your Registration - Easy Travels";
        $action_text = "Verify Email Address";
        $main_text = "Welcome to Easy Travels! Please confirm your email address to activate your account.";
        $color = "#22c55e"; // Green
    } else {
        $page = 'index.php';
        $subject = "Password Reset Request - Easy Travels";
        $action_text = "Reset Password";
        $main_text = "We received a request to reset your Easy Travels account password. Click below to proceed.";
        $color = "#ef4444"; // Red
    }

    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("mali.aryan423@gmail.com", "Easy Travels");
    $email->setSubject($subject);
    $email->addTo($uemail, $name);

    $email_template = '
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            @media only screen and (max-width: 600px) {
                .container { width: 100% !important; }
                .logo { max-width: 200px !important; }
            }
        </style>
    </head>
    <body style="margin: 0; padding: 0; font-family: Arial, sans-serif;">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td style="padding: 40px 20px; background-color: #f8fafc;">
                    <table class="container" width="600" align="center" cellpadding="0" cellspacing="0" style="background: white; border-radius: 8px; padding: 30px;">
                        <tr>
                            <td align="center">
                                <img src="[Your-Logo-URL]" class="logo" alt="Easy Travels" style="max-width: 250px; height: auto; margin-bottom: 30px;">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 30px 20px; color: #1e293b; font-size: 16px;">
                                <h2 style="color: ' . $color . '; margin-top: 0;">Hello ' . $name . ',</h2>
                                <p>' . $main_text . '</p>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="padding: 20px 0 30px;">
                                <a href="' . SITE_URL . $page . '?' . $type . '&email=' . $uemail . '&token=' . $token . '" 
                                   style="background-color: ' . $color . '; color: white; padding: 14px 28px; 
                                          text-decoration: none; border-radius: 6px; font-weight: bold; 
                                          display: inline-block; font-size: 16px;">
                                    ' . $action_text . '
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 20px 30px; border-top: 1px solid #e2e8f0; color: #64748b; font-size: 14px;">
                                <p>If you didn\'t request this, you can safely ignore this email.</p>
                                <p>Need help? Contact our support team at support@easytravels.com</p>
                                <p style="margin-top: 20px;">© ' . date("Y") . ' Easy Travels. All rights reserved.</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>';

    $email->addContent("text/html", $email_template);

    $sendgrid = new \SendGrid(SENDGRID_API_KEY);
    try {
        $sendgrid->send($email);
        return 1;
    } catch (Exception $e) {
        return 0;
    }
}



if (isset($_POST['register'])) {
    $data = filteration($_POST);
    if ($data['pass'] != $data['cpass']) {
        echo 'pass_mismatch';
        exit;
    }

    
    if (strlen($data['pass']) < 8) {
        echo 'pass_short';
        exit;
    }

    if (!preg_match("/[A-Za-z]/", $data['pass']) || !preg_match("/\d/", $data['pass']) || !preg_match("/[@$!%*?&]/", $data['pass'])) {
        echo 'pass_weak';
        exit;
    }

    //match password

    //check user exist or not
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1", [$data['email'], $data['phonenum']], "ss");
    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit;
    }
    //upload user image to server
    //
    $img = uploadUserImage($_FILES['profile']);//$_FILES['file']['name']: The original name of the uploaded file (as provided by the user).
    if ($img == 'inv_img') {
        echo $img;
        exit;
    } else if ($img == 'upd_failed') {
        echo 'upd_failed';
        exit;
    }
    //send confirrm link to user mail
    $token = bin2hex(random_bytes(16));
    if (!send_mail($data['email'], $data['name'], $token, "email_confirmation")) {
        echo 'mail_failed';
        exit;
    }
    //send grid
    $enc_pass = password_hash($data['pass'], algo: PASSWORD_BCRYPT);
    $query = "INSERT INTO `user_cred`( `name`, `email`, `address`, `phonenum`, `profile`, `password`,  `token`) 
    VALUES (?,?,?,?,?,?,?)";
    $values = [$data['name'], $data['email'], $data['address'], $data['phonenum'], $img, $enc_pass, $token];
    if (insert($query, $values, 'sssssss')) {
        echo 1;
    } else {
        echo 'ins_failed';
    }

}

if (isset($_POST['login'])) {


    $data = filteration($_POST);
    $u_exist = select(
        "SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",
        [$data['email_mob'], $data['email_mob']],
        "ss"
    );
    if (mysqli_num_rows($u_exist) == 0) {
        echo 'inv_email_mob';
        exit;
    } else {
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if ($u_fetch['is_verified'] == 0) {
            echo 'not_verified';

        } else if ($u_fetch['status'] == 0) {
            echo 'inactive';

        } else {
            if (!password_verify($data['pass'], $u_fetch['password'])) {
                echo 'invalid_pass';
            } else {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['uId'] = $u_fetch['id'];
                $_SESSION['em'] = $u_fetch['email'];
                $_SESSION['uName'] = $u_fetch['name'];
                $_SESSION['uPic'] = $u_fetch['profile'];
                $_SESSION['uPhone'] = $u_fetch['phonenum'];
                echo 1;
            }

        }
    }
    // else {
//         if (!password_verify($data['pass'], $u_fetch['password'])) {
//             echo 'invalid_pass';
//         }

    //     }
}


if (isset($_POST['forgot_pass'])) {
    $data = filteration($_POST);
    $u_exist = select(
        "SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1",
        [$data['email']],
        "s"
    );
    if (mysqli_num_rows($u_exist) == 0) {
        echo 'inv_email';

    } else {
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if ($u_fetch['is_verified'] == 0) {
            echo 'not_verified';
        } else if ($u_fetch['status'] == 0) {
            echo 'inactive';
        } else {
            $token = bin2hex(random_bytes(16));
            //send reset link to email
            if (!send_mail($data['email'], $u_fetch['name'], $token, "account_recovery")) {
                echo 'mail_failed';
            } else {
                $date = date("Y-m-d");
                $query = mysqli_query($con, "UPDATE `user_cred` SET `token`='$token', `t_expire`='$date' 
                WHERE `id`='$u_fetch[id]'");
                if ($query) {
                    echo 1;
                } else {
                    echo 'upd_failed';
                }
            }
        }
    }

}


if (isset($_POST['recover_user'])) {
    $data = filteration($_POST);
    $enc_pass = password_hash($data['pass'], algo: PASSWORD_BCRYPT);
    $query = "UPDATE `user_cred` SET `password`=?, `token`=? ,`t_expire`=?
     WHERE `email`=? AND `token`=?";
    $values = [$enc_pass, null, null, $data['email'], $data['token']];
    if (update($query, $values, 'sssss')) {
        echo 1;
    } else {
        echo 'failed';
    }


}

?>