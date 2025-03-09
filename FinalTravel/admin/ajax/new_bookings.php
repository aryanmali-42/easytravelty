<?php
require('../../connection.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['get_bookings'])) {

    $frm_data = filteration($_POST);
    $query = "SELECT bo.*,bd.* FROM `orders` bo
    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
    WHERE (bd.booking_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?)
    AND (bo.booking_status=?) ORDER BY bo.booking_id desc";
    $res = select(
        $query,
        ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%", "booked"],
        'ssss'
    );
    $i = 1;
    $table_data = "";
    if (mysqli_num_rows($res) == 0) {
        echo "<b>NO DATA FOUND</b>"
        ;
        exit;
    }
    while ($data = mysqli_fetch_assoc($res)) {
        $date = date("d-m-Y", strtotime($data['added_date']));
        $table_data .= "
            <tr>
                <td>$i</td>
                <td>
                <span class='badge bg-warning text-dark'>
            Booking ID: $data[booking_id]</span>
                </span>
                <br>
                 <b> Name:</b> $data[user_name]
                 
                <br>
                 <b> Phone No:</b> $data[phonenum]
                 </td>
                 <td>
                 <b>Package:</b>$data[package_name]
                    <br>
                 <b> Price of one    Package:</b>₹$data[price]<br>
                 <b>Total Travellers:</b>$data[quantity]
                

                 </td>

                 <td>
                    <b>Total Paid:</b>₹ $data[trans_amt]
                    <br>
                    <b>Date:</b> $date

                 </td>
                    <td>
                    <button type='button' onclick='cancel_booking($data[booking_id])' class='btn btn-sm btn-white fw-bold btn-outline-danger shadow-none'>
                      <i class='bi bi-trash'></i>      Cancel Booking
                    </button>
                
                    </td>
                 
            </tr>
            
            ";
        $i++;
    }
    echo $table_data;
}








if (isset($_POST['cancel_booking'])) {
    $frm_data = filteration($_POST);
    $query = "UPDATE `orders` SET `booking_status`=? , `refund`=? WHERE booking_id=? ";
    $values = ['cancelled', 0, $frm_data['booking_id']];
    $res = update($query, $values, 'sii');
    echo $res;

}
