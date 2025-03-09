<?php
require('../../connection.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['get_bookings'])) {

    $frm_data = filteration($_POST);
    $limit = 1;
    $page = $frm_data['page'];
    $start = ($page - 1) * $limit;

    //page1 pe hu me 1-1 = 0 0*10 = 0  so 0,10
    // agar page 2 var snd keke (2-1)*10 so 1*10 =10 manje 2nd page var 10th row pasun start hoil 
    //page3 3-1 = 2*10 20 pasun start hoill



    $query = "SELECT bo.*,bd.* FROM `orders` bo
    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
    WHERE ((bo.booking_status='booked') 
    OR (bo.booking_status='cancelled' AND bo.refund=1))
    AND (bd.booking_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?)
     ORDER BY bo.booking_id desc";
    $res = select(
        $query,
        ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%"],
        'sss'
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

        if ($data['booking_status'] == 'booked') {
            $status_bg = "bg-success";
        } else {
            $status_bg = "bg-danger";
        }
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
                 <b>Single Package Price:</b>₹$data[price]<br>
               
                 <b>Total Travellers:</b>   $data[quantity]
                 </td>

                 <td>
                    <b>Total Paid:</b>₹ $data[trans_amt]
                    <br>
                    <b>Date:</b> $date

                 </td>
                 <td>
                    <span class='badge $status_bg'>$data[booking_status]</span>
                 </td>
                    <td>
                    <button type='button' onclick='download($data[booking_id])' class='btn btn-white fw-bold btn-outline-primary shadow-none'>
                      <i class='bi bi-filetype-pdf'></i>  
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
