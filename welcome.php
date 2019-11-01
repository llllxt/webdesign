<?php
session_start();
include 'connect.php';
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$dateofbirth = $_POST['dateofbirth'];

if($firstname || $lastname){
	$query = 'UPDATE customers SET first_name="'.$firstname.'" , last_name="'.$lastname.'" WHERE email="'.$_SESSION['valid_user'].'"';
}

if($query){
echo '<script> alert("Edit Successfully") </script>';
$result = $conn -> query($query);
if($result){
	$_SESSION['firstname'] = $firstname;
	$_SESSION['lastname'] = $lastname;
}
}


?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
<style type="text/css">
  .text{
    text-decoration: none;
    color: black;
    font-weight: bold;
  }
   .dropdown{     
    height:30px;  
    width:auto;  
    line-height:28px;  
    border:1px solid #9bc0dd;  
    -moz-border-radius:2px;  
    -webkit-border-radius:2px;  
    border-radius:2px; 
    font-size: 1.2em; 

   }
   .filter{
    width: 80%;
    margin-left: auto;
    margin-right: auto;
   }
   
   #wrapper{
   	width: 80%;
   	margin:auto;
   	min-width: 1000px;
   }
   #left{
   	width: 10%;
   	margin-left: 10%;
   	float: left;
   	margin-top: 50px;
   	
   }
   #right { 
   	width: 100%;
   	min-height: 300px;
   	margin-top: 50px;
   	margin-left: 100px;
   	background-color: #f5f5f5;
   	display: inline-block;
} 

   #left ul{
   	  list-style: none;
	  background-color: #FFFFFF;
	  text-align: center;
	  padding: 0;
	  margin: 0;
   }
   #left li{
   	width: 230px;
    border-bottom: none;
    height: 50px;
    line-height: 50px;
    font-size: 1em;
    margin-right: -4px;
   }
   #left a{
   	font-size: 1.5em;
   	font-family: monospace; 
   	text-decoration: none;
    color: black;
    display: block;
    border-bottom: 1px solid #888;
    transition: .3s background-color;
    border-bottom: 1px;
   }
   #right p{
   	font-size: 1.5em;
   	font-family: cursive;
   	text-align: center;
   }
   #right img{
   	width: 100%;
   }

.inputform{
    width: 70%;
    margin-right: auto;
    margin-left: auto;

  }
label{
	font-size: 1.5em;
   	font-family: monospace; 
   	text-decoration: none;
    color: black;
    display: block;
    border-bottom: 1px solid #888;
    transition: .3s background-color;
    border-bottom: 1px;
}
  .submitbutton{
        padding: 5px;
        color: black;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        
        margin-left: 40px;

       }
  .wishlist:after{
    content: "";
  clear: both;
  display: table;
  }
  .wishlist_img{
    float: left;
     width:50%;
    height:50%;
  }
}

</style>
</head>

<body>
	 <?php 
include 'header.php'; ?>
<div id="wrapper">
	<table>
		<tr>
			<td>
  	<div id="left">
  		<ul>
  			<li><a href='welcome.php?type=myaccount'>MY ACCOUNT</a></li>
  			<li><a href='welcome.php?type=details'>MY DETAILS</a></li>
  			<li><a href='welcome.php?type=history'>ORDER HISTORY</a></li>
  			<li><a href='welcome.php?type=wishlist'>WISH LIST</a></li>
  		</ul>
  	</div>
  </td>
  <td>
  	<div id="right" style="width: 500px;">
  		<?php
  		$type = $_GET['type'];

      $sql1= 'SELECT id FROM customers WHERE email = "'.$_SESSION['valid_user'].'"';
      $result1 = mysqli_query($conn, $sql1);
      $row1 = mysqli_fetch_assoc($result1);
      $user_id = $row1['id'];


  		if(!$type || $type=="myaccount"){
  			echo '
               <div style="background-color:white;">
			  		<p>Hi '.$_SESSION['firstname'].' '.$_SESSION['lastname'].'!, Welcome to Phoebe.</p>
			  	</div>
			  	<div>
			  	<a href="welcome.php?type="wishlist""><img src="img/account.jpg"></a>
			  	</div>
			  	<br>
			  	<div style="width:10%; margin-left:auto;margin-right:auto">
			  	<a style="text-decoration:none" href="logout.php"><button type="button" value="Log out">Log out</a>
			  	</div>
  			';
  		}else if($type=="details"){
  			echo '
  			<div style="float:left">
  			<br><br><br>
  		<form class="inputform" method="post" action="" onsubmit="chkall();">
		
		<div >
			<label for="firstname">First Name: </label>
			<input type="text" id="firstname" name="firstname" value="'. $_SESSION["firstname"] .'" Required>
		</div>
		<div >
			<label>Last Name: </label>
			<input type="text" id="lastname" name="lastname" value="'.$_SESSION["lastname"]. '" Required>
		</div>
		
    <br><br>
		<div >
			<input type="submit" class="submitbutton" name="reg_user" value="Edit" style="background-color: #f5f5f5;padding: 5px">
		</div>
    <br><br>
  </form>
  </div>
  <div>

  <img style="float:right;margin-left:20px;margin-top:50px;width:250px; height:250px" src="img/about2.jpg">
  </div>

  ';

  	}else if($type=="history"){
    $history_order_num=0;
    echo '<table border="0" style="margin-left:30px">';
    

     $sql2= 'SELECT id, date_order_placed, total_price from t_order WHERE customer_id = '.$user_id;
     $result2 = mysqli_query($conn, $sql2);
     if (mysqli_num_rows($result2)>0) {
     
     while($row2 = mysqli_fetch_array($result2)) {
      $history_order_num++;
       echo 
       '<tr>
       <div> <b>ORDER'.$history_order_num.'</b></div
            <div style="float:right; margin-right:10px;margin-bottom:20px"> Order Time:'.$row2['date_order_placed'].'<br></div>
        </tr>
        ';
        $sql3 = 'SELECT product_id, order_item_quantity, order_item_price FROM order_items WHERE order_id ='.$row2['id'];
        $result3 = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result3)>0) {
        while($row3 = mysqli_fetch_array($result3)) {
            $sql4 = 'SELECT name, price, image1, discount FROM products WHERE id = '.$row3['product_id'];
            $result4 = mysqli_query($conn, $sql4);
            $row4 = mysqli_fetch_assoc($result4);
            echo '
            <tr>
              
                <div style="width:20%;height:20%"><a href="detail.php?id='.$row3['product_id'].'"><img src= '.$row4['image1'].'></a></div>
                <div> <b>'.$row4['name'].'</b></div>
         
              <div> Quantity: '.$row3['order_item_quantity'].' </div>
              <div> Price: $'.$row4['price']*$row4['discount'].' </div>
              <div> Sub Total: $'.$row3['order_item_price'].' </div>
             
            </tr>

            '
            ;
          }

        }
         echo '
         <tr>
        <div style="float:right; margin-right:10px;margin-bottom:20px"><b>Total Price: $'.$row2['total_price'].'</b></div>
        </tr>
        <tr>
        <div style="margin-bottom:20px;"> <hr> </div>
        </tr>
           ';
      }
    }
    echo '</table>';

  }else if($type=="wishlist"){

    $sql2= 'SELECT product_id FROM wishlist WHERE customer_id = '.$user_id;
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result2)>0) {
      echo '<div class="wishlist">';
      while($row2 = mysqli_fetch_array($result2)) {
        $sql3 = 'SELECT image1 FROM products WHERE id = '.$row2['product_id'];
        $result3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_assoc($result3);

        echo '
        <div class="wishlist_img">
        <a href="detail.php?id='.$row2['product_id'].'"><img src= '.$row3['image1'].'></a>
        </div>

        ';
    }
    echo '</div>';
  }


  }
  	?>

  	</div>
  </td>
</tr>
</table>
  </div>
<?php include 'footer.php';
?>
</body>

</html>
