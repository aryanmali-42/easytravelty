<?php
require('../connection.php');
require('../admin/inc/essentials.php');
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}
if (isset($_POST['review_form'])) {
    $frm_data = filteration($_POST);
    $upd_query = "UPDATE `orders` SET `rate_review`=?  WHERE `booking_id`=? AND `user_id`=? ";
    $upd_values = [0, $frm_data['booking_id'], $_SESSION['uId']];
    $upd_result = update($upd_query, $upd_values, 'iii');

    $ins_query = "INSERT INTO `rating_review`( `boking_id`, `package_id`, `user_id`, `rating`, `review`) VALUES (?,?,?,?,?)";
    $ins_values = [$frm_data['booking_id'], $frm_data['package_id'], $_SESSION['uId'], $frm_data['rating'], $frm_data['review']];
    $ins_result = insert($ins_query, $ins_values, 'iiiis');
    echo $ins_result;
}
?>