<?php session_start(); ?>
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
  min-width: 100px;
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
<div> <h2 style="text-align:center"> SHOPPING CART </h2><br></div>

<?php
include 'connect.php';

if (!isset($_SESSION['valid_user'])){
  echo '<div style="text-align: center"><b> Please log in to add items to your shopping cart!</b></div>';

} else {
 
$user_email = $_SESSION['valid_user'];
//echo $_SESSION['valid_user'];
$sql= 'SELECT id FROM customers WHERE email = "'.$user_email.'"';
//echo $sql;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$user_id = $row['id'];
//echo $user_id;


//delete function
if (isset($_GET['delete_flag']) && $_GET['delete_flag']==1){
  $sql1 = 'DELETE FROM shopping_cart WHERE  customer_id = '.$user_id. ' AND product_id = '.$_GET['product_id']; 
if (mysqli_query($conn, $sql1)) {
  
  unset($_GET['delete_flag']);
} else {
  //echo "Error deleting record";
}
}

// increase the product quantity
if(isset($_GET['increase']) && $_GET['increase']==1 && $_GET['quantity_num']!=null){
  $sql = "SELECT stock FROM products WHERE id = ".$_GET['product_id'];
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  // when the selected quantity is equal to the quantity in stock => can not increase anymore
  if ($row['stock'] <= $_GET['quantity_num']){

   echo '<script> alert("Already reach the maximun quantity '.$row['stock'].' for the product in stock. You can not increase the quantity anymore.")</script>';
   $sql1 = 'UPDATE shopping_cart SET item_quantity = '.$row['stock'].' WHERE customer_id = '.$user_id. ' AND product_id = '.$_GET['product_id'];
  if (mysqli_query($conn, $sql1)) {
  unset($_GET['increase']);
} else {
  //echo "Error deleting record";
}
  
  } else{
  $new_quantity_num= $_GET['quantity_num']+1;
  $sql1 = 'UPDATE shopping_cart SET item_quantity = '.$new_quantity_num.' WHERE customer_id = '.$user_id. ' AND product_id = '.$_GET['product_id'];
  if (mysqli_query($conn, $sql1)) {
  unset($_GET['increase']);
} else {
  //echo "Error deleting record";
}
}
}
// decrease the product quantity
if(isset($_GET['decrease']) && $_GET['decrease']==1 && $_GET['quantity_num']!=null){
 if ($_GET['quantity_num']>1){
  $new_quantity_num= $_GET['quantity_num']-1;
  $sql1 = 'UPDATE shopping_cart SET item_quantity = '.$new_quantity_num.' WHERE customer_id = '.$user_id. ' AND product_id = '.$_GET['product_id'];
  if (mysqli_query($conn, $sql1)) {
  unset($_GET['decrease']);
} else {
  //echo "Error deleting record";
}
}
}


function searchForItemsInCart($user_id,$conn){
  $price=0;
  $sql = "SELECT product_id, item_quantity FROM shopping_cart WHERE customer_id = ". $user_id;
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result)> 0) {
   echo '
    <form method="post" action="order.php">
 <table border="0" class="table1">
      <tr>
        
        <th><h3>Product Description</h3></th>
        <th><h3>Item Price</h3></th>
        <th><h3>Quantity</h3></th>
        <th><h3>Subtotal</h3></th>
        <th><h3>Edit</h3></th>
      </tr> 
      ';
    while($row = mysqli_fetch_array($result)) {

      $sql1 = "SELECT name,price,color,category,image1,discount FROM products WHERE id = ".$row['product_id'];
      $result1 = mysqli_query($conn, $sql1);
      $row1 = mysqli_fetch_assoc($result1);
      $sub_total = $row1['price']*$row['item_quantity']*$row1['discount'];
      $price = $price+$row1['price']*$row['item_quantity']*$row1['discount'];
      $item_price = $row1['price']*$row1['discount'];

      echo '
      <th>
        <div class="left-column">
        <a herf="detail.php?id='.$row['product_id'].'">
          <img src='.$row1['image1'].' style="width: 120px;height: 120px" /></a>
        </div>
        <table border="0" class="table">
          <tr><th>'.$row1['name'].'</th> </tr>
          <tr><td>Color:'.$row1['color'].'</td></tr>
          <tr><td>Category:'.$row1['category'].'</td></tr>
        </table> 
      </th>
      
      <td> $'.$item_price.' </td>

      <td class="right-column" id="quantityform">
        <a href="cart.php?product_id='.$row['product_id'].'&user_id='.$user_id.'&quantity_num='.$row['item_quantity'].'&decrease=1"><img src="img/minus.jpg"  width="15px" height="15px"></a><input type="text" id="quantity" disabled="disabled" size="2" value="'.$row['item_quantity'].'"><a href="cart.php?product_id='.$row['product_id'].'&user_id='.$user_id.'&quantity_num='.$row['item_quantity'].'&increase=1"><img src="img/plus.jpg" width="15px" height="15px"></a>
      </td>
      
      <td> $'.$sub_total.'</td>

      <td>
        <a href="cart.php?product_id='.$row['product_id'].'&user_id='.$user_id.'&delete_flag=1">Delete</a>
      </td>
 
      </tr> 
       ';
    }

  echo '
  </table><br>
  <div style="text-align:right; margin-right: 150px; margin-bottom: 50px; min-width:100px">
      <b>Total Price: $'.$price.'</b>
  </div>
   
      <input type="submit" class ="green_add" style="float:right; margin-right: 150px;"  name="checkout" value="Checkout">
      <input type="hidden" name="wishlist_item_id" value=" '.$product_id.'"/> <br> 
  
  ';
  
  } else{
    echo '
    <div style="text-align: center"><b> There is no item in your shopping cart. </b></div>
    ';
  }
}

//display all the items in the shopping cart for the user
searchForItemsInCart($user_id,$conn);

}
?>
</form>
</div>
</body>
<?php include 'footer.php'; ?>
</html>