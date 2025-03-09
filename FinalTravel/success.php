<?php
error_reporting(0);

include('connection.php');
require('admin/inc/essentials.php');
require("inc/sendgrid-php/sendgrid-php.php");
session_start();


use SendGrid\Mail\Mail;

$uId = $_SESSION['uId'];
$userEmail = $_SESSION['em'];

$query = "SELECT * FROM `orders` WHERE `user_id` = ? ORDER BY `added_date` DESC LIMIT 1";

$result = select($query, [$uId], "s"); // "s" indicates a string type parameter

$order = mysqli_fetch_assoc($result);
if (!$order) {
  echo "<h2>No recent payment found!</h2>";
  exit();
}

// Define the SQL query for fetching the booking details
$query2 = "SELECT * FROM `booking_details` WHERE `booking_id` = ?";

// Call the select function for booking details
$result2 = select($query2, [$order['booking_id']], "s"); // "s" for string type parameter

$booking = mysqli_fetch_assoc($result2);


date_default_timezone_set('Asia/Kolkata'); // Set IST timezone

// Convert the added_date to a DateTime object (assuming the stored date is in UTC)
$date = new DateTime($data['added_date'], new DateTimeZone('UTC')); // Assuming UTC in DB
$date->setTimezone(new DateTimeZone('Asia/Kolkata')); // Convert to IST

// Format the date as desired
$formatted_date = $date->format("H:ia | d-m-Y");

// Send email using SendGrid
$email = new Mail();
$email->setFrom("mali.aryan423@gmail.com", "Easy Tours And Travels");
$email->setSubject("Booking Confirmation - Order #" . $order['booking_id']);
$email->addTo($userEmail);
$email->addContent("text/html", "
    <h2>Payment Successful! 🎉</h2>
    <p>Thank you for your payment. Your booking details are below:</p>
    <p><strong>Order ID:</strong> {$order['booking_id']}</p>
    <p><strong>Transaction ID:</strong> {$order['payment_id']}</p>
    <p><strong>Total Packages:</strong> {$order['quantity']}</p>
    <p><strong>Price For Single Package:</strong> ₹{$booking['price']}</p>
    <p><strong>Total Paid Amount:</strong> ₹{$booking['totalprice']}></p>
    <p><strong>Package Name:</strong> {$booking['package_name']}</p>
    <p><strong>Price:</strong> ₹{$booking['price']}</p>
    <p><strong>Name:</strong> {$booking['user_name']}</p>
    <p><strong>Phone:</strong> {$booking['phonenum']}</p>
    <p><strong>Address:</strong> {$booking['address']}</p>
    <p><strong>Address:</strong> {$booking['totalprice']}</p>
    <p><strong>Date:</strong> {$formatted_date}</p>
    
");
//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
// Send email using SendGrid API key
$sendgrid = new \SendGrid('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');

try {
  $response = $sendgrid->send($email);
} catch (Exception $e) {
  echo "Email sending failed: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Successful | Easy Tours</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #ffc400;
      /* Changed to a more vibrant blue */
      --success: #28a745;
      --surface: #ffffff;
      --background: #f8f9fa;
      /* Light background for better contrast */
      --text-primary: #343a40;
      /* Darker text for better readability */
      --text-secondary: #6c757d;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #e9ecef, #f8f9fa);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

    .confirmation-card {
      background: var(--surface);
      border-radius: 1.5rem;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
      max-width: 800px;
      width: 100%;
      overflow: hidden;
      position: relative;
      animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .header-section {
      background: linear-gradient(135deg, var(--primary), #0056b3);
      color: white;
      padding: 3rem 2rem;
      /* Increased padding for better spacing */
      text-align: center;
      position: relative;
    }

    .header-content {
      max-width: 500px;
      margin: 0 auto;
    }

    .status-icon {
      width: 80px;
      height: 80px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.5rem;
    }

    .status-icon svg {
      width: 40px;
      height: 40px;
      color: white;
    }

    .header-title {
      font-size: 2rem;
      /* Increased font size */
      font-weight: 700;
      margin-bottom: 0.75rem;
    }

    .header-subtitle {
      color: rgba(255, 255, 255, 0.9);
      line-height: 1.5;
    }

    .content-section {
      padding: 2.5rem;
    }

    .detail-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      /* Adjusted min width */
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .detail-card {
      background: var(--background);
      border-radius: 0.75rem;
      padding: 1.5rem;
      /* Increased padding */
      border-left: 4px solid var(--primary);
      transition: transform 0.2s;
      /* Added transition */
    }

    .detail-card:hover {
      transform: translateY(-2px);
      /* Hover effect */
    }

    .detail-label {
      color: var(--text-secondary);
      font-size: 0.9rem;
      /* Slightly larger font size */
      font-weight: 500;
      margin-bottom: 0.5rem;
    }

    .detail-value {
      color: var(--text-primary);
      font-weight: 600;
      font-size: 1.25rem;
      /* Increased font size */
    }

    .amount-card {
      background: linear-gradient(135deg, var(--primary), #0056b3);
      color: white;
      border-radius: 0.75rem;
      padding: 1.5rem;
      margin: 2rem 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .amount-label {
      font-size: 1rem;
      opacity: 0.9;
    }

    .amount-value {
      font-size: 2rem;
      /* Increased font size */
      font-weight: 700;
    }

    .button-group {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      margin-top: 2rem;
    }

    .btn {
      padding: 0.875rem 1.5rem;
      border-radius: 0.75rem;
      text-decoration: none;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 0.75rem;
      transition: all 0.3s ease;
      /* Increased transition duration */
    }

    .btn-primary {
      background: var(--primary);
      color: white;
    }

    .btn-primary:hover {
      background: #0056b3;
      /* Darker shade on hover */
      transform: translateY(-2px);
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
      /* Increased shadow */
    }

    .btn-secondary {
      background: var(--background);
      color: var(--text-primary);
      border: 1px solid #e2e8f0;
    }

    .btn-secondary:hover {
      background: #f1f5f9;
      transform: translateY(-2px);
    }

    .timeline {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin: 2rem 0;
      padding: 1.5rem;
      background: var(--background);
      border-radius: 0.75rem;
    }

    .timeline-icon {
      width: 40px;
      height: 40px;
      background: var(--primary);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .timeline-icon svg {
      width: 20px;
      height: 20px;
      color: white;
    }

    .timeline-content {
      flex-grow: 1;
    }

    .timeline-title {
      font-weight: 600;
      margin-bottom: 0.25rem;
    }

    .timeline-description {
      color: var(--text-secondary);
      font-size: 0.875rem;
    }

    @media (max-width: 640px) {
      .confirmation-card {
        border-radius: 1rem;
      }

      .header-section {
        padding: 2rem;
        /* Adjusted for smaller screens */
      }

      .content-section {
        padding: 1.5rem;
      }

      .button-group {
        flex-direction: column;
      }

      .btn {
        justify-content: center;
        width: 100%;
        /* Full width buttons on small screens */
      }
    }
  </style>
</head>

<body>
  <div class="confirmation-card">
    <div class="header-section">
      <div class="header-content">
        <div class="status-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path fill-rule="evenodd"
              d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
              clip-rule="evenodd" />
          </svg>
        </div>
        <h1 class="header-title">Booking Confirmed!</h1>
        <p class="header-subtitle">Your payment was successful and your booking is now confirmed. A detailed receipt has
          been sent to your email.</p>
      </div>
    </div>

    <div class="content-section">
      <div class="detail-grid">
        <div class="detail-card">
          <div class="detail-label">Booking ID</div>
          <div class="detail-value"><?= htmlspecialchars($order['booking_id']) ?></div>
        </div>
        <div class="detail-card">
          <div class="detail-label">Transaction ID</div>
          <div class="detail-value"><?= htmlspecialchars($order['payment_id']) ?></div>
        </div>
        <div class="detail-card">
          <div class="detail-label">Package Name</div>
          <div class="detail-value"><?= htmlspecialchars($booking['package_name']) ?></div>
        </div>
        <div class="detail-card">
          <div class="detail-label">Booking Date And Time</div>
          <div class="detail-value"><?= htmlspecialchars($formatted_date) ?></div>
        </div>
      </div>

      <div class="amount-card">
        <div class="amount-label">Total Paid</div>
        <div class="amount-value">₹<?= number_format($booking['totalprice']) ?></div>
      </div>

      <div class="timeline">
        <div class="timeline-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path
              d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
            <path fill-rule="evenodd"
              d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
              clip-rule="evenodd" />
          </svg>
        </div>
        <div class="timeline-content">
          <div class="timeline-title">Next Steps</div>
          <div class="timeline-description">We'll send your travel documents and itinerary to your email within 24
            hours.</div>
        </div>
      </div>

      <div class="button-group">
        <a href="bookings.php" class="btn btn-primary">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
            <path
              d="M11.644 1.59a.75.75 0 01.712 0l9.75 5.25a.75.75 0 010 1.32l-9.75  5.25a.75.75 0 01-.712 0l-9.75-5.25a.75.75 0 010-1.32l9.75-5.25z" />
            <path
              d="M3.265 10.602l7.668 4.129a2.25 2.25 0 002.134 0l7.668-4.13 1.37.739a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.71 0l-9.75-5.25a.75.75 0 010-1.32l1.37-.738z" />
            <path
              d="M10.933 19.231l-7.668-4.13-1.37.739a.75.75 0 000 1.32l9.75 5.25c.221.12.489.12.71 0l9.75-5.25a.75.75 0 000-1.32l-1.37-.738-7.668 4.13a2.25 2.25 0 01-2.134-.001z" />
          </svg>
          View Bookings
        </a>
        <a href="generate_pdf.php?gen_pdf&amp;id=<?= htmlspecialchars(string: $order['booking_id']) ?>"
          class="btn btn-secondary">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
            <path d="M6 2a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H6zm0 2h12v16H6V4z" />
            <path d="M8 6h8v2H8V6zM8 10h8v2H8v-2zM8 14h8v2H8v-2z" />
          </svg>
          Print Receipt
        </a>
      </div>
    </div>
  </div>
</body>

</html>