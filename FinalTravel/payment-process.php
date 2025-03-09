<?php
include('connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pay_now'])) {
	date_default_timezone_set("Asia/Calcutta");

	// Get form data
	$quantity = (int) $_POST['quantity'];
	$price_per_person = (float) $_POST['price'];
	$total_price = $price_per_person * $quantity;
	// Validate input
	if ($quantity < 1 || $price_per_person <= 0) {
		echo json_encode(["status" => "error", "message" => "Invalid booking details"]);
		exit;
	}
	$ORDER_ID = $_SESSION['uId'] . random_int(11111, 999999);
	$CUST_ID = $_SESSION['uId'];
	$package_id = $_POST['package_id'];
	$package_name = $_POST['package_name'];
	$name = $_POST['name'];
	$phonenum = $_POST['phonenum'];
	$address = $_POST['address'];

	mysqli_begin_transaction($con);

	try {
		// Insert into orders with quantity and total price
		$query1 = "INSERT INTO `orders` (`booking_id`, `user_id`, `package_id`, `trans_amt`, `quantity`, `added_date`) 
                   VALUES (?, ?, ?, ?, ?, NOW())";

		insert($query1, [
			$ORDER_ID,
			$CUST_ID,
			$package_id,
			$total_price,
			$quantity
		], 'sssdi');

		// Insert into booking_details with quantity
		$query2 = "INSERT INTO `booking_details` 
                  (`booking_id`, `package_name`, `price`, `quantity`, `totalprice`, `user_name`, `phonenum`, `address`) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

		insert($query2, [
			$ORDER_ID,
			$package_name,
			$price_per_person,
			$quantity,
			$total_price,
			$name,
			$phonenum,
			$address
		], 'ssddssss');

		mysqli_commit($con);

		echo json_encode([
			"status" => "success",
			"amount" => $total_price,  // Send total amount to Razorpay
			"package_name" => $package_name,
			"package_id" => $package_id,
			"quantity" => $quantity
		]);

	} catch (Exception $e) {
		mysqli_rollback($con);
		error_log("Payment Error: " . $e->getMessage());
		echo json_encode([
			"status" => "error",
			"message" => "Payment processing failed"
		]);
	}
}
?>