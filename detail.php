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
  padding: 30px 50px;
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
	padding-top: 8px;
	padding-bottom: 8px;
	font-size: 12px;
	float: right;
	width:200px;
	text-align: center;	
}

.grey_add{
	background-color:#e7e7e7;
	color: black;
	padding-top: 8px;
	padding-bottom: 8px;
	font-size: 12px;
	width:200px;
	float: middle;
}


</style>
</head>
<script>

//checking the input number of items and notify the user
function addToCart(){
	alert("Item has been added to shopping cart!");
}

function addToWishlist(){
	//can add function to send email to user!
	alert("Item has been added to your wish list!");
}
function alreadyInWishlist(){
	alert("Item is already in your wish list!");
}

function login(){
	alert("Please log in to add items to your shopping cart or wish list.");
}

function inputQuantity(){
	alert("Please input a positive quantity number!");
}

function inputLesserQuantity(){
	var val = "<?php echo $avalible_quantity ?>";
	alert("Please input a lesser value for the quantity! There are "+val +" items in stock");
}

</script>
<body>
	<div class="wrapper">
		<?php
    // session_start();

		include 'connect.php';
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



        //validate input quantity and insert to shopping cart table
		if (isset($_GET['submit']) ){
			if(isset($_SESSION['valid_user'])){
			$sql0 = "SELECT stock FROM products WHERE id=".$product_id;
			//echo $sql;
			$result0 = mysqli_query($conn, $sql0);
			$row0 = mysqli_fetch_assoc($result0);
            $avalible_quantity = $row0['stock'];

				if($_GET['quantity']>0 &&  $_GET['quantity']<= $avalible_quantity && isset($_GET['quantity'])){
				echo '<script> addToCart();</script>';
			$sql = "SELECT item_quantity FROM shopping_cart WHERE customer_id =".$user_id." AND product_id = ".$product_id;
			// if the selected item is alread yin the shopping cart, we update the quantity of items 
			$result=mysqli_query($conn, $sql);
			if (mysqli_num_rows($result)>0){
				$row = mysqli_fetch_array($result);
				$update_quantity = $_GET['quantity']+$row['item_quantity'];
				$sql1 = "UPDATE shopping_cart SET item_quantity = ".$update_quantity." WHERE customer_id =".$user_id." AND product_id = ".$product_id;
				if (mysqli_query($conn, $sql1)) {
				 //echo "record updated successfully";
				} else {
				 //echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
				}
			}
            // if the selected item is not in the shopping cart, we insert a new record
			else {
				$sql2 = "INSERT INTO shopping_cart (customer_id,product_id,item_quantity) VALUES ( ".$user_id.", ".$product_id.", ".$_GET['quantity']." )";
				if (mysqli_query($conn, $sql2)) {
				//echo "New record created successfully";
				} else {
				//echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
				}
			}
		}else if ($_GET['quantity']>$avalible_quantity && isset($_GET['quantity'])){
             echo '<script> alert("Please input a lesser value for the quantity! There are '.$avalible_quantity.' items in stock")</script>';
		}
		else{
			echo '<script> inputQuantity();</script>';
		}
	}
		else{
			echo '<script> login();</script>';
			
		}
		unset($_GET['quantity']);
		unset($_GET['submit']);
		} 
		
		 // add the item to wishlist table
		if (isset($_GET['wishlist_item_id'])){
			if(isset($_SESSION['valid_user'])){
			$product_id = $_GET['wishlist_item_id'];
			$sql0 = "SELECT * FROM wishlist WHERE customer_id = ".$user_id." AND product_id = ".$product_id;
			$result0=mysqli_query($conn, $sql0);
			if (mysqli_num_rows($result0)<1){
				
				$sql = "INSERT INTO wishlist (customer_id,product_id) VALUES ( ".$user_id.", ".$product_id." )";
				//echo $sql;
				if (mysqli_query($conn, $sql)) {
					//echo "New record created successfully";
					echo '<script> addToWishlist();</script>';
				} else {
					//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}else{
				echo '<script> alreadyInWishlist();</script>';
			}
		}else{
				echo '<script> login();</script>';
				//echo "test2";
			}
			unset($_GET['wishlist_item_id']);

		}

		// select information about the product
		$sql = "SELECT name, sub_category, price, detail, stock, color, theme, image1, image2, discount FROM products WHERE id=".$product_id;
		//echo $sql;
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		
		echo '
		<table>
		<tr><td width="40%">
			<div style="min-width:60%; margin-left:10%;">
	
				<div>
					<h3>'.$row['name'].'</h3>
				</div>
				<div> 
					Category: '.$row['sub_category'].'<br><br>
				</div>
				<div> 
					Detail：<br>'.$row['detail'].'<br><br>
				</div> 
				<div> 
					Color: '.$row['color'].'<br><br>
				</div>
				<div> 
					Theme: '.$row['theme'].'<br><br>
				</div>
		';

		// if there is no discont for the product, only show the original price
		if ($row['discount']==1){
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
			    <div> 
					Stock Quantity: '.$row['stock'].'<br><br>
				</div>
				<form  action="detail.php" method="get">
				<div> 
					Quantity: <input type="number" min="0" step="1" placeholder="quantity"  name="quantity" id="quantity"> 
				</div>
				<div>
					<br><input type="submit" class ="green_add" name="submit" value="Add to Shopping Cart"><input type="hidden" name="id" value=" '.$product_id.'"/>
					<br><br>
				</div>
				</form>
				<form  action="detail.php" method="get">
				<div>
					<br><input type="submit" class ="green_add" name="wishlist" value="Add to Wish List"><input type="hidden" name="wishlist_item_id" value=" '.$product_id.'"/><input type="hidden" name="id" value=" '.$product_id.'"/>
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
					<br><input type="submit" class ="green_add" name="wishlist" value="Add to Wish List"><input type="hidden" name="wishlist_item_id" value=" '.$product_id.'"/>
				</div>
				</form>';
		}

		echo '
			</div>
			</td>
			<td width="60%">
				<div style="min-width:60%; margin-left:10%;"> <img src="'.$row['image1'].'" width="40%" height="40%">
				<img src="'.$row['image2'].'" width="40%" height="40%"> </div>
			
			</td></tr>
		</div>
		</table>
		';			
		?>
	
	
	</body>

<?php include 'footer.php';  ?> 

</html>