<?php
    $servername = "127.0.0.1";
	$username = "root";
	$password = "xxxx";
	$db = "f34ee";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $db);

	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}   
    $user_id = 4;
    $product_id = 7;
	$quantity = $_GET['quantity'];
	echo $quantity ;
	$sql1 = 'INSERT INTO shopping_cart (customer_id,product_id,item_quantity) VALUES ( '.$user_id.', '.$product_id.', '.$quantity.' )';
	
	if (mysqli_query($conn, $sql1)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
	}

?>