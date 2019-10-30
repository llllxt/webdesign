<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
<style>


.column{
  margin-top: 40px;
  float: left;
  padding-left:5%;

}
.leftpart{
  width:25%;
  min-width: 20%;
}

.rightpart{
  width:75%;
  min-width: 60%;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.wrapper{
	width:100%;
	min-width: 100%;
	float: center; 
	display: block;
}
.red{
	color: red;
}
.button{
	background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 30px 70px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  margin: 30px 70px;
  cursor: pointer;
}

.green_add{
	background-color: #4CAF50;
	color: white;
	padding: 7px 30px;
	font-size: 12px;
	float: right;	
}

.grey_add{
	background-color:#e7e7e7;
	color: black;
	padding: 7px 30px;
	font-size: 12px;
	float: middle;
}


</style>
</head>
<body>
	<div class="wrapper">
		<?php
    // session_start();
		$conn = new mysqli("127.0.0.1", "root", "xxxx","f34ee");
		if($conn->connection_error){
		  include_once("error.php");
		  exit();
		}
		include 'header.php';
		
		// parse user email and get user_id
		$user_email = $_SESSION['valid_user'];
		$sql= 'SELECT id FROM customers WHERE email = "'.$user_email.'"';
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$user_id = $row['id'];
		//echo $user_id;

		
		// pass the product id from shop overview to this detail pages
		if (isset($_GET['id'])) {
			// echo $product_id;
			$product_id = $_GET['id'];
		}

        // add the item to wishlist table
		if (isset($_GET['wishlist_item_id'])){
			$product_id = $_GET['wishlist_item_id'];
			$sql = "INSERT INTO wishlist (customer_id,product_id) VALUES ( ".$user_id.", ".$product_id." )";
			//echo $sql;
			if (mysqli_query($conn, $sql)) {
				//echo "New record created successfully";
			} else {
				//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}

		}

        //validate input quantity and insert to shopping cart table
		if (isset($_GET['quantity']) && $_GET['quantity']>0){
			$sql1 = "INSERT INTO shopping_cart (customer_id,product_id,item_quantity) VALUES ( ".$user_id.", ".$product_id.", ".$_GET['quantity']." )";
			if (mysqli_query($conn, $sql1)) {
				//echo "New record created successfully";
			} else {
				//echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
			}
		} 
			
		// select information about the product
		$sql = "SELECT name, sub_category, price, detail, stock, color, theme, image1, image2, discount FROM products WHERE id=".$product_id;
		//echo $sql;
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		
		echo '
		<div class="row">
			<div class="column leftpart">
				<div>
					<h3>'.$row['name'].'</h3>
				</div>
				<div> 
					Category:'.$row['sub_category'].'<br><br>
				</div>
				<div> 
					Detail：<br>'.$row['detail'].'<br><br>
				</div> 
				<div> 
					Color:'.$row['color'].'
				</div>
				<div> 
					Theme:'.$row['theme'].'<br><br>
				</div>
		';

		// if there is no discont for the product, only show the original price
		if ($row['discount']=1){
			echo '
				<div> 
					Price: $'.$row['price'].'<br><br>
				</div>';
		} else{
			// if there is discont for the product, show the original price and the price on sale in red color
			$percent_off = (1-$row['discount'])*100;
			echo '
				<div>
					<del>Original Price: $'.$row['price'].'</del><br>
				</div>
				<div class="red"> 
					Sale: $'.$row['price']*$row['discount'].'('.$percent_off.'% off)<br><br>
				</div>';
		}

		
        //check if the product is in stock, if it is in stock, we show the add to bag button
		//if not, we disable add to bag button and show notify me buttom.
		if ($row['stock']>=1) {
			echo '
				<form  action="detail.php" method="get">
				<div> 
					Quantity: <input type="number" min="0" step="1" placeholder="quantity"  name="quantity" id="quantity"> 
				</div>
				<div>
					<br><input type="submit" class ="green_add" name="submit" onclick="notify()" value="Add to Bag"><input type="hidden" name="id" value=" '.$product_id.'"/>
				</div>
				</form>';
				
		}
		else{
			echo '
				<form  action="detail.php" method="get">
				<div class="red"><br>
					The item you have chosen is out of stock. You can add it to your wishlist!
				</div>
				<div>
					<br><input type="submit" class ="green_add" onclick="joinInWaitList()" name="wishlist" value="Add to wishlist"><input type="hidden" name="wishlist_item_id" value=" '.$product_id.'"/>
				</div>
				</form>';
		}

		echo '
			</div>
			<div class="column rightpart">
				<img src="'.$row['image1'].'" width="30%" height="30%">
				<img src="'.$row['image2'].'" width="30%" height="30%">
			</div>
		</div>
		';			
		?>
		
		<div class="center" style="text-align: center; margin-top:100px; margin-bottom:40px">
			<h2>DISCOVER MORE</h2>
		<button class="grey_add" onclick="location.href='index.php'" type="button">
			<b>Shop Here</b>
		</button> <br><br>
		</div>
	</body>
<script>

//checking the input number of items and notify the user
function notify(){
	quantity = document.getElementById("quantity");
	if (quantity<=0){
		alert("Please input an positive number!");
	}else{
	alert("Item has been added to shopping bag!");
	}
}

function joinInWaitList(){
	//can add function to send email to user!
	alert("Item has been added to your wishlist!");
}
</script>
<?php include 'footer.php';  ?> 

</html>