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
$db = "f34ee";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    //die("Connection failed: " . mysqli_connect_error());
}
//echo "connected to database";
$user_id = "1";
function searchForItemsInCart($user_id,$conn){ 
  $price=0;
  $sql = "SELECT product_id, item_quantity FROM shopping_cart WHERE customer_id = ". $user_id;
  $result = mysqli_query($conn, $sql);
  echo "<table border='0' id='table'>";
  if (mysqli_num_rows($result)> 0) {
    while($row = mysqli_fetch_assoc($result)) {
      // echo $row['SUM(qty)']."<br>";
   //       echo $row['SUM(amount)']."<br>";
      $sql1 = "SELECT name, price,image1 FROM products WHERE id = ".$row['product_id'];
      $result1 = mysqli_query($conn, $sql1);
      $row1 = mysqli_fetch_assoc($result1);
      // echo '<img src="images/icon-phone.png" alt="icon" />';
      // <div><img src="../webimgs/787801NBP_RGB.jpeg"></div>

      //echo $row1['image1'];

      $price = $price+$row1['price']*$row['item_quantity'];

      echo"
      <tr>
      <td><img src=".$row1['image1']." style='width: 20px;height: 20px' /></td>
      <th>".$row1['name']."</th> 
      <td >Item Price:$".$row1['price']."</td>
      <td>Quantity:".$row['item_quantity']. "</td>
      <td>SubTotalPrice:$".$row1['price']*$row['item_quantity']."</td>
      </tr
       ";
    }
  echo "</table>";
  echo "<div style='float:right; margin-right: 100px'><b>Total Price:".$price."</b></div>";
}
}
searchForItemsInCart($user_id,$conn);
?>
</html>