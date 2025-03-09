<?php
require('../../connection.php');
require('../inc/essentials.php');
adminLogin();
if (isset($_POST['get_bookings'])) {
    $frm_data = filteration($_POST);
    $query = "SELECT bo.*,bd.* FROM `orders` bo
    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
    WHERE (bd.booking_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?)
    AND (bo.booking_status=? AND bo.refund=?) ORDER BY bo.booking_id desc";
    $res = select(
        $query,
        ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%", "cancelled", 0],
        'sssss'
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
                 <td>      <b>Package:</b>$data[package_name]
                    <br>
               <b>Date:</b> $date<br>
                       <b>Total Price:</b>₹$data[totalprice]<br>
                 <b>Total Travellers:</b>   $data[quantity]
                 </td>

                 <td>
               
                    <b>₹ $data[trans_amt]</b>
                    <br>
                  

                 </td>
                    <td>
                    <button type='button' onclick='refund_booking($data[booking_id])' class='btn btn-sm btn-white fw-bold btn-outline-success shadow-none'>
                      <i class='bi bi-cash-stack'></i>      Refund Money
                    </button>
                
                    </td>
                 
            </tr>
            
            ";
        $i++;
    }
    echo $table_data;
}
if (isset($_POST['refund_booking'])) {
    $frm_data = filteration($_POST);
    $query = "UPDATE `orders` SET `refund`=? WHERE booking_id=? ";
    $values = [1, $frm_data['booking_id']];
    $res = update($query, $values, 'ii');
    echo $res;

}




