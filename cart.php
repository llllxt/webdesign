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
.middle-column{
  margin-left: 200px;
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
</style>
</head>

<body>
<div id="wrapper">
<?php include 'header.php'; ?>
<div> <h2 style="text-align:center" >SHOPPING CART </h2><br></div>
<form method="post" action="updatecart.php">
 <table border="0" class="table1">
      <tr >
        <th><h3>Product Description</h3></th>
        <th><h3>Item Price</h3></th>
        <th><h3>Quantity</h3></th>
        <th><h3>Edit</h3></th>
      </tr> 
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


// $user_id = $_GET["id"];
$user_id = "1";
$_SESSION['user_id']=$user_id;
function searchForItemsInCart($user_id,$conn){ 
  $price=0;
  $sql = "SELECT product_id, item_quantity FROM shopping_cart WHERE customer_id = ". $user_id;
  $result = mysqli_query($conn, $sql);
  // echo '
  // <table border="0" id="table">
  // <td> Products </td>
  // <td> Name </td>
  // <td> Price </td>
  // <td> Quantity </td>

  // ';

  if (mysqli_num_rows($result)> 0) {
    while($row = mysqli_fetch_assoc($result)) {
      // echo $row['SUM(qty)']."<br>";
   //       echo $row['SUM(amount)']."<br>";
      $sql1 = "SELECT name,price,color,category,image1 FROM products WHERE id = ".$row['product_id'];
      $result1 = mysqli_query($conn, $sql1);
      $row1 = mysqli_fetch_assoc($result1);
      // echo '<img src="images/icon-phone.png" alt="icon" />';
      // <div><img src="../webimgs/787801NBP_RGB.jpeg"></div>

      //echo $row1['image1'];

      $price = $price+$row1['price']*$row['item_quantity'];

      echo '
      <tr>
      
      <th>
        <div class="left-column"><img src='.$row1['image1'].' style="width: 120px;height: 120px" /></div>
        <table border="0" class="table">
         <tr><th>'.$row1['name'].'</th> </tr>
         <tr><td>Color:'.$row1['color'].'</td></tr>
         <tr><td>Category:'.$row1['category'].'</td></tr>
        </table> 
      </th>
      
      <td> $'.$row1['price'].' </td>

      <td id="quantityform"><button type="button" id="decrease_quantity" onclick="minus()"><img src="img/minus.jpg"  width="15px" height="15px"> </button> <input type="text" id="quantity" value="'.$row['item_quantity'].'">
      <button type="button" id="increas_quantity" onclick="add();"> <img src="img/plus.jpg" width="15px" height="15px"></button></td>

      <td> <input type="image" id="delete_item" src="img/delete.jpg" width="20px" height="20px"> </td>
 
      </tr> 
       ';
    }
  echo '
  </table><br>
  <div style=" text-align:right; margin-right: 200px; margin-bottom: 100px; min-width:100px"><b>Total Price: $'.$price.'</b></div>
   <div style="float:right;margin-right: 200px">
  <a href="cart.php?id='.$_SESSION['user_id'].'">Checkout</a></div>
  </form>
  ';
  
  }
}



searchForItemsInCart($user_id,$conn);

?>
</div>
<!-- <script  type="text/javascript" src="updatecart.js"></script> -->
<script  
function add(){
    alert("testing");
    quantity = document.getElementById("quantity");
    quantity.value = quantity.value +1;
    return quantity;
}></script>
</body>

<?php include 'footer.php'; ?>

</html>