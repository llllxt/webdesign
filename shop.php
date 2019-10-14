<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
<style type="text/css">
	.select-items div,.select-selected {
	  color: black;
	  padding: 3px 3px;
	  border: 1px solid transparent;
	  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
	  cursor: pointer;
	  user-select: none;
	}
</style>
</head>
<body>
	<div class="wrapper">
		<?php
		// session_start();
		// $con = new mysqli("");
		// if($con->connection_error){
		// 	include_once("error.php");
		// 	exit();
		// }
		include 'header.php';
		
        $type= $_GET['type'];

        $pageNum=0;
        foreach($_GET as $param_name => $param_value){
        	if($param_name == 'type'){
        		$cond = "";
        		foreach($param_value as $category){
        			$cond = $cond . $param_name . '="'. $category .'")';

        		}

        	}
        }
        


        echo '
        <div class="slide-container">
		    <div class="slide">
		      <img src="img/slide1.jpg" style="width:100%">
		    </div>
		    <div class="slide">
		      <img src="img/slide2.jpg" style="width:100%">
		    </div>
		    <div class="slide">
		      <img src="img/slide3.jpg" style="width:100%">
		    </div>
		  </div>
		  <br>
        ';

        echo'
         <div class="filterbar"  style="width:50%; margin-left: auto;margin-right: auto; float: left;">
		<div class="custom-select filter">     
		      <select id="color" >
		        <option value="0">color</option>
		        <option value="1">Pink</option>
		        <option value="2">Blue</option>
		        <option value="3">Red</option>
		        <option value="4">Multicolor</option>
		      </select>
		 </div>
		 <div class="custom-select filter" >     
		      <select id="price">
		      <option value="0">price</option>
		      <option value="1">0-50</option>
		      <option value="2">50-100</option>
		      <option value="3">100-150</option>
		      <option value="4">150-200</option>
		      <option value="5">200+</option>
		    </select>
		 </div>
		 <div class="custom-select filter" >     
		      <select id="theme" >
		        <option value="0">theme</option>
		        <option value="1">Career Aspiration</option>
		        <option value="2">Animals &amp; Pets</option>
		        <option value="3">Firytale</option>
		        <option value="4">Flower &amp; nature</option>
		        <option value="5">Love &amp; Romance</option>
		      </select>
		 </div>
		</div>

        ';

        $query = 'SELECT FROM products WHERE';
        $result = $conn->query($query);
        if($result){
        	$num_rows = $result->num_rows;
        	if($num_rows>0){
        		echo '<div class="row">'
        		for($i=0; $i<num_rows;$i++){
        			$row = $result.fetch_assoc();
	        		$product_id=$row["id"];
	        		$product_name = stripslashes($row["name"]);
	        		$product_price = $row["price"];
	        		$discount = $row['discount'];
	        		echo "<div class="3cols">";
	        		include 'product.php';
	        		echo "</div>";

        		}
        		$result->free();
        		echo "</div>";


        		
        		?>

        	}
        }

        ?>



<script type="text/javascript" src='javascript/slide.js'></script>
<script type="text/javascript" src='javascript/filter.js'></script>
</div>
</body>
</html>

