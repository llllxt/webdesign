<?php
session_start();
include 'connect.php';


// parse user email and get user_id
$user_email = $_SESSION['valid_user'];
$sql= 'SELECT id FROM customers WHERE email = "'.$user_email.'"';
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$user_id = $row['id'];
// echo $user_id;

// get the local order time
date_default_timezone_set('Asia/Singapore');
$current_time = date('Y-m-d H:i:s');
$order_time=$current_time;
// echo $date;
if(isset($_POST['checkout'])){
    
    // carete a new order record and insert it to the t_order table
	$sql0='INSERT INTO t_order (customer_id, date_order_placed, total_price) VALUES ('.$user_id.', "'.$order_time.'", 0 )';
	//echo $sql0."<br>";
	// echo $sql0."<br>";
	if (mysqli_query($conn, $sql0)) {
		//echo "ok"."<br>";
		//echo "New record created successfully";
	} else {
		//echo "not ok"."<br>";
		//echo "Error: " . $sql0 . "<br>" . mysqli_error($conn);
	}

    // get the id of the new created order record in t_order table ()
	$sql5='SELECT id  FROM t_order WHERE customer_id = '.$user_id.' AND date_order_placed = "'.$order_time.'"';
	//echo $sql5."<br>";
	$result5 = mysqli_query($conn, $sql5);
	$row5 = mysqli_fetch_assoc($result5);
	//echo $row5['id']."<br>";;
	$order_id = $row5['id'];
	//echo "ok"."<br>";
	
		 
	//get with the items in shopping cart
	$sql = "SELECT product_id, item_quantity FROM shopping_cart WHERE customer_id = ". $user_id;

	//echo $sql."<br>";
    $result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result)> 0) {
   		while($row = mysqli_fetch_array($result)) {
      
	        // get related  information about the product
	    	$sql1 = "SELECT name,price,discount,stock FROM products WHERE id = ".$row['product_id'];
	      	$result1 = mysqli_query($conn, $sql1);
	      	$row1 = mysqli_fetch_assoc($result1);
	      	$price = $price+$row1['price']*$row['item_quantity'];
	      	//echo $sql1."<br>";

            // item price after the discount
	      	$subprice = $row['item_quantity']*$row1['price']*$row1['discount'];
	      	//echo $row1['name']."<br>";

            //insert records to order_items table
	      	$sql2="INSERT INTO order_items (product_id, order_id, order_item_quantity, order_item_price) VALUES (" .$row['product_id'].", ".$order_id.", ".$row['item_quantity']. ", ".$subprice.")";

	      	//echo $sql2."<br>";
	      	if (mysqli_query($conn, $sql2)) {
	      		//echo "ok"."<br>";
				//echo "New record inserted successfully";
			} else {
				//echo "not ok"."<br>";
				//echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
			}

            $updated_stock = $row1['stock']-$row['item_quantity'];
			//update the quantity in product table
			$sql6='UPDATE products SET stock ='.$updated_stock.' WHERE id='.$row['product_id'];
			echo $sql6."<br>";
			if (mysqli_query($conn, $sql6)) {
				echo "ok"."<br>";
				
			} else {
				echo "Error: " . $sql6 . "<br>" . mysqli_error($conn);
			}

		} 

		    // insert the total order amount to t_order table  -- ok tetsted
			$sql3="UPDATE t_order SET total_price = ".$price." WHERE id = ".$order_id;
			//echo $sql3."<br>";
			if (mysqli_query($conn, $sql3)) {
				//echo "ok"."<br>";
				//echo "New record inserted successfully";
			} else {
				//echo "not ok"."<br>";
				//echo "Error: " . $sql0 . "<br>" . mysqli_error($conn);
			}
		}

		//delect the items in the shopping cart  -- ok tetsted
		$sql4 = "DELETE FROM shopping_cart WHERE  customer_id = ".$user_id; 
		//echo $sql4."<br>";
		if (mysqli_query($conn, $sql4)) {
			//echo "record deletedsuccessfully";
			//echo "$sql4 ok"."<br>";
			} else {
				//echo "$sql4 not ok"."<br>";
				//echo "Error: " . $sql4 . "<br>" . mysqli_error($conn);
			}
      		
}
include "email.php";
?>

