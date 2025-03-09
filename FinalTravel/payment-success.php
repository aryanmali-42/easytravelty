<?php
include('connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $payment_id = $_POST['payment_id'];
    $package_id = $_POST['package_id'];
    $bookingstatus = 'booked';
    $query1 = "UPDATE `orders` SET `payment_id` = ? WHERE `package_id`=?";
    insert($query1, [$payment_id, $package_id], 'ss');
    $query2 = "UPDATE `orders` SET `booking_status` =? WHERE `package_id`=?";
    insert($query2, [$bookingstatus, $package_id], 'ss');
    $uId = $_SESSION['uId'];
    $query = "SELECT * FROM `orders` WHERE `user_id` = ? ORDER BY `added_date` DESC LIMIT 1";
    $result = select($query, [$uId], "s");
    $order = mysqli_fetch_assoc($result);
    $query3 = "UPDATE `packages` 
    SET `adult` = `adult` - $order[quantity]
    WHERE `id` = ?";
    insert($query3, [$package_id], 's');
    echo "done";

}
?>