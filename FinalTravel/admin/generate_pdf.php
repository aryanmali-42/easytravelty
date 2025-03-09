<?php
require('inc/essentials.php');
require('../connection.php');
require('inc/mpdf/vendor/autoload.php');
date_default_timezone_set(timezoneId: "Asia/Calcutta");

adminLogin();

if (isset($_GET['gen_pdf']) && $_GET['id']) {  //get because not sending or modifying
    $frm_data = filteration($_GET);
    $query = "SELECT bo.*,bd.*,uc.email  FROM `orders` bo
    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
    INNER JOIN `user_cred` uc ON bo.user_id = uc.id
    WHERE ((bo.booking_status='booked') 
    OR (bo.booking_status='cancelled' AND bo.refund=1))
    AND bo.booking_id='$frm_data[id]'";
    $res = mysqli_query($con, $query);
    $total_rows = mysqli_num_rows($res);
    if ($total_rows == 0) {
        header('location:dashboard.php');
        exit;
    }
    $data = mysqli_fetch_assoc($res);
    $date = date("H:ia | d-m-Y", strtotime($data['added_date']));

    $table_data = "
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: #2d3436;
        background-color: #f8f9fa;
    }
    
    .header {
        border-bottom: 2px solid #e74c3c;
        padding-bottom: 20px;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .company-name {
        color: #e74c3c;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .receipt-title {
        font-size: 24px;
        color: #2c3e50;
        margin: 20px 0;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    
    .details-table {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }
    
    .details-table th,
    .details-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    .details-table th {
        background-color: #e74c3c;
        color: white;
        font-weight: 600;
    }
    
    .details-table tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    
    .status-badge {
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        display: inline-block;
    }
    
    .confirmed {
        background-color: #27ae60;
        color: white;
    }
    
    .cancelled {
        background-color: #e74c3c;
        color: white;
    }
    
    .total-section {
        background-color: #2c3e50;
        color: white;
        padding: 20px;
        border-radius: 8px;
        margin-top: 30px;
    }
    
    .footer {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #ddd;
        text-align: center;
        color: #7f8c8d;
    }
    
    .watermark {
        opacity: 0.1;
        position: fixed;
        bottom: 50%;
        right: 50%;
        transform: translate(50%, 50%);
        font-size: 80px;
        color: #2c3e50;
        pointer-events: none;
    }
</style>


<div class='header'>
    <div class='company-name'>Easy Tours & Travels</div>
    <div style='color: #7f8c8d; margin-bottom: 15px;'>Booking Receipt</div>
</div>

<h2 class='receipt-title'>Booking Confirmation</h2>

<table class='details-table'>
    <tr>
        <th>Booking ID</th>
        <td>{$data['booking_id']}</td>
        <th>Booking Date</th>
        <td>{$date}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td colspan='3'>
            <span class='status-badge " . ($data['booking_status'] == 'cancelled' ? 'cancelled' : 'confirmed') . "'>
                {$data['booking_status']}
            </span>
        </td>
    </tr>
    <tr>
        <th>Customer Name</th>
        <td>{$data['user_name']}</td>
        <th>Contact Email</th>
        <td>{$data['email']}</td>
    </tr>
    <tr>
        <th>Phone Number</th>
        <td>{$data['phonenum']}</td>
        <th>Your Address</th>
        <td>{$data['address']}</td>
    </tr>
    <tr>
        <th>Package Name</th>
        <td>{$data['package_name']}</td>
        <th>Package Price</th>
        <td>₹{$data['price']} / package</td>
    </tr>";

    if ($data['booking_status'] == 'cancelled') {
        $refund = ($data['refund']) ?
            "<span style='color: #27ae60'>✓ Refund Processed</span>" :
            "<span style='color: #e74c3c'>ⓘ Refund Pending</span>";
        $table_data .= "
    <tr>
        <th>Amount Paid</th>
        <td>₹{$data['trans_amt']}</td>
        <th>Refund Status</th>
        <td>{$refund}</td>
    </tr>";
    } else {
        $table_data .= "
    <tr>
        <th>Package Number</th>
        <td>{$data['package_id']}</td>
        <th>Total Amount Paid</th>
        <td>₹{$data['trans_amt']}</td>
    </tr>";
    }

    $table_data .= "
</table>

<div class='total-section'>
    <div style='font-size: 20px; margin-bottom: 10px;'>Payment Summary</div>
    <div style='display: flex; justify-content: space-between;'>
        <div>Package Quantity:</div>
        <div>{$data['quantity']} × ₹{$data['price']}</div>
    </div>
    <div style='display: flex; justify-content: space-between; margin-top: 10px; font-weight: 600;'>
        <div>Total Amount:</div>
        <div>₹{$data['trans_amt']}</div>
    </div>
</div>

<div class='footer'>
    <div style='margin-bottom: 10px;'>Thank you for choosing Easy Tours & Travels!</div>
    <div style='font-size: 12px;'>
        Contact: mali.aryan423@gmail.com | Phone: +91 9137632053
    </div>
</div>";

    // Create PDF
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'margin_left' => 15,
        'margin_right' => 15,
        'margin_top' => 25,
        'margin_bottom' => 25,
        'margin_header' => 10,
        'margin_footer' => 10,
        'default_font' => 'roboto'
    ]);

    // Add custom font
    $mpdf->fontdata['roboto'] = [
        'R' => 'Roboto-Regular.ttf',
        'B' => 'Roboto-Bold.ttf'
    ];

    $mpdf->SetWatermarkText('Easy Tours');
    $mpdf->showWatermarkText = true;
    $mpdf->watermarkTextAlpha = 0.1;

    $mpdf->WriteHTML($table_data);
    $mpdf->Output($data['booking_id'] . '.pdf', 'D');

} else {
    header('location:index.php');
}
?>