<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
<style>


.column{
  margin-top: 50px;
  float: left;
  text-align: center;

}
.leftpart{
  width:30%;
  text-align: left;
  margin-left:100px;
  min-width: 400px;


}

.rightpart{
  width:60%;
  margin-right:30px;
  min-width: 650px;
  
  
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.wrapper{
	width:100%;
	min-width: 1800px;
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
		$conn = new mysqli("127.0.0.1", "root", "Fukua971005","f34ee");
		if($conn->connection_error){
		  include_once("error.php");
		  exit();
		}
		include 'header.php';

        // parse value form session input
		// $user_id = $_SESSION['user_id'];
		// $product_id = $_SESSION['product_id'];

		//for testing
		$user_id = 3;
		$product_id = 7;

		// $quantity = (empty($_GET['quantity']) ? 0 : $_GET['quantity']);

		if (isset($_GET['quantity']) && $_GET['quantity']>0){
			$sql1 = 'INSERT INTO shopping_cart (customer_id,product_id,item_quantity) VALUES ( '.$user_id.', '.$product_id.', '.$_GET['quantity'].' )';
			if (mysqli_query($conn, $sql1)) {
				//echo "New record created successfully";
			} else {
				//echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
			}
		} 
			
		
		$sql = 'SELECT name,sub_category,price,detail,stock,color,theme,image1,image2,discount FROM products WHERE id='.$product_id;
		// echo $sql;
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
		if ($row['stock']<1) {
			echo '
				<form  action="detail.php" method="get">
				<div> 
					Quantity: <input type="number" min="0" step="1" placeholder="quantity"  name="quantity" id="quantity"> 
				</div>

				<div>
					<input type="submit" class ="green_add" name="submit" onclick="notify()" value="Add to Bag">
				</div>
				</form>';
				
		}
		else{
			echo '
				<div class="red"><br>
					The item you have chosed is out of stock. You can join in our waiting list!
				</div>
				<div>

					<br><input type="submit" class ="green_add" onclick="joinInWaitList()" value="Join waiting list">
				</div>';
		}
		
		echo '
			</div>
			<div class="column rightpart">
				<div> 
				<img src="'.$row['image1'].'" width="350px" height="350px">
				<img src="'.$row['image2'].'" width="350px" height="350px">
				</div>
			</div>
		</div>
		';			
		?>
		
	</div>
	<div class="center" style="text-align: center; margin-top:100px; margin-bottom:40px"><h2>DISCOVER MORE</h2>
	<button class="grey_add" onclick="location.href='index.php'" type="button"><b>Shop Here</b></button> <br><br></div>
</body>
<script>

//checking the input number of items and notify the user
function notify(){
	quantity = document.getElementById("quantity");

	if (quantity<=0){
		alert("Please input an positive number!");
	}else{
	alert("Item has been added to shopping bag");
	}
}

function joinInWaitList(){
	//can add function to send email to user!
	alert("You are now in the waiting list!");
}
</script>
<?php include 'footer.php';  ?> 

</html>