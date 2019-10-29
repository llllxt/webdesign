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
$username = "root";
$password = "xxxx";
$db = "f34ee";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$to      = 'f34ee@localhost';
$subject = 'Order Confirmation';
$message = 'Thanks for your ordering at Phoebe';
'Thanks for your ordering at Phoebe';
$message = '
<html>
<body>
	<img src="img/header2.jpg" style="text-align: center;margin-bottom: 10px;">
	<h3 style="text-align: center; margin-bottom: 30px;">Thanks for your ordering at Phoebe! <br></h3>
	<h3 style="text-align: left; margin-bottom: 20px;">Order summary <br></h3>
	<table border="0" class="table1">
      <tr>
        <th><h3>Product Description</h3></th>
        <th><h3>Item Price</h3></th>
        <th><h3>Quantity</h3></th>
      </tr> 
	';

$sql = "SELECT product_id, item_quantity FROM shopping_cart WHERE customer_id = ". $user_id;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)> 0) {
    while($row = mysqli_fetch_array($result)) {

      $sql1 = "SELECT name,price,color,category,image1 FROM products WHERE id = ".$row['product_id'];
      $result1 = mysqli_query($conn, $sql1);
      $row1 = mysqli_fetch_assoc($result1);
      
      $price = $price+$row1['price']*$row['item_quantity'];

      $message .= ' 
      <tr>
    
      <th>
        <div>
          <img src='.$row1['image1'].' style="width: 120px; height: 120px" />
        </div>
        <table border="0" class="table">
          <tr><th>'.$row1['name'].'</th> </tr>
          <tr><td>Color:'.$row1['color'].'</td></tr>
          <tr><td>Category:'.$row1['category'].'</td></tr>
        </table> 
      </th>
      
      <td> $'.$row1['price'].' </td>

      <td>'.$row['item_quantity'].'</td>
 
      </tr> 
       ';

  	}
}

$message .='
  </table><br>
  <div style="text-align:right; margin-right: 150px; margin-bottom: 50px; min-width:100px">
      <b>Total Price: $'.$price.'</b>
  </div>
</body>
</html>
';

$headers = 'From: f34ee@localhost' . "\r\n" .
    'Reply-To: f34ee@localhost' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers,'-ff32ee@localhost');
?> 

</body>

<?php include 'footer.php'; ?>
</html>
