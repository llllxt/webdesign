<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
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
		$product = $_GET["id"];
		?>
		
		<div class="leftcolumn">

		</div>
		<div class="rightcolumn">
		</div>
	</div>
</body>
