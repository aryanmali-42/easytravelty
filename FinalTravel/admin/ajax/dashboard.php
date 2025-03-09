<?php
require('../../connection.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['booking_statistics'])) {


    $frm_data = filteration($_POST);

    $condition = "";
    if ($frm_data['period'] == 1) {
        $condition = "WHERE added_date BETWEEN NOW() - INTERVAL 30 DAY AND NOW()"; //abhi jo time ho rha usce 30 days piche jana hai      $condition = "WHERE added_date BETWEEN (NOW() - INTERVAL 30 DAY) AND NOW()";
    } else if ($frm_data['period'] == 2) {
        $condition = "WHERE added_date BETWEEN NOW() - INTERVAL 90 DAY AND NOW()"; //abhi jo time ho rha usce 90 days piche jana hai      $condition = "WHERE added_date BETWEEN (NOW() - INTERVAL 30 DAY) AND NOW()";
    }

    $result = mysqli_fetch_assoc(mysqli_query($con, "SELECT 
  
    COUNT(CASE WHEN booking_status!='pending' THEN 1 END) AS `total_bookings`,
    SUM(CASE WHEN booking_status!='pending' THEN `trans_amt` END) AS `total_amt`,



    COUNT(CASE WHEN booking_status='booked' THEN 1 END) AS `active_bookings`,
    SUM(CASE WHEN booking_status='booked' THEN `trans_amt` END) AS `active_amt`,

    COUNT(CASE WHEN booking_status='cancelled' AND refund=1 THEN 1 END) AS `cancelled_bookings`,
    SUM(CASE WHEN booking_status='cancelled' AND refund=1 THEN `trans_amt` END) AS `cancelled_amt`
    FROM `orders` $condition")); // yaha hume count krna hai , case madhe when keyword use krtot its an condition id else true or false

    $output = json_encode($result);
    echo $output;

}
