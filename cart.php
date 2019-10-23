<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<div id="wrapper">
<?php include 'header.php'; ?>
<div> <h2>SHOPPING BAG </h2></div>
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "xxxx";
$db = "javajam_coffee";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "connected to database"
$user_id = "1"
function searchForItemsInCart($user_id,$conn){ 
  $sql = "SELECT product_id, item_quantity FROM shopping_cart WHERE customer_id = ". $user_id;
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      // echo $row['SUM(qty)']."<br>";
   //       echo $row['SUM(amount)']."<br>";
      $sql1 = "SELECT name, price,image1 FROM products WHERE id = ". $row['product_id'];
      $result1 = mysqli_query($conn, $sql);
      $row1 = mysqli_fetch_assoc($result);

      echo <div> <img src=$row1['image1'] style="width:100%"></div>
      echo <div> $row1['name']</div>
      echo <div> $row1['price']</div>
      echo <div> $row['item_quantity']</div>
      echo <div> $row1['price']*$row['item_quantity']</div>
    }
  }
}
searchForItemsInCart($user_id,$conn)
?>
</html>