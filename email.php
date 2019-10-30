<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
<style>
.left-column{
  margin-left: 100px;
  margin-right: 20px;
  float:left;
  width: 15%;
  min-width: 110px;
}

.right-column{
  min-width:200px;
}

.table{
  text-align: left;
  min-width: 200px;
}

.table1{
  width:90%;
  min-width: 800px;
  text-align: center; 
}

.green_add{
  background-color:#4CAF50;
  color: white;
  padding: 7px 30px;
  font-size: 12px;
  margin-bottom: 200px;
  float: right;
}
</style>
</head>

<body>
<div id="wrapper">
<?php include 'header.php'; ?>
<div style="text-align: center; margin-top:40px;"">
<h2> Thanks for your shopping at Phoebe. <br> </h2>
<h3>A comfirmation email has been sent to your email! </h3>
</div>

<?php
$servername = "127.0.0.1";
$username = "f34ee";
$password = "f34ee";
$db = "f34ee";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$user_id = 1;

$to      = 'f34ee@localhost';
$subject = 'Order Confirmation';
$message = 'Thanks for your ordering at Phoebe'."\n";

$message .= 'Product Description / Item Price / Quantity'."\n";

$sql = "SELECT product_id, item_quantity FROM shopping_cart WHERE customer_id = ". $user_id;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)> 0) {
    while($row = mysqli_fetch_array($result)) {

      $sql1 = "SELECT name,price,color,category,image1 FROM products WHERE id = ".$row['product_id'];
      $result1 = mysqli_query($conn, $sql1);
      $row1 = mysqli_fetch_assoc($result1);
      
      $price = $price+$row1['price']*$row['item_quantity'];


      $message .=  $row1['name'].' / '.$row1['price'].' / '.$row['item_quantity']."\n";
	
  	}
}
$message .='Total Price: $'.$price;
$headers = 
	'From: f34ee@localhost' . "\r\n" .
    'Reply-To: f34ee@localhost' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers,'-ff34ee@localhost');
// check https://192.168.56.2:20000/

?> 

</body>

<?php include 'footer.php'; ?>
</html>