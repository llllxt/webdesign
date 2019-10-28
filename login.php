<?php
session_start();
$conn = new mysqli("127.0.0.1", "root", "Fukua971005","f34ee");
    if($conn->connection_error){
      include_once("error.php");
      exit();
    }
$myusername = $_POST['username'];
$mypassword = $_POST['password'];
$mypassword = md5($mypassword);
echo $myusername;
$query = 'SELECT id FROM customers WHERE email="'.$myusername. '" AND password="' . $mypassword .'"';
$result = $conn -> query($query);
if($result->num_rows > 0){
	$_SESSION['valid_user'] = $myusername;
	echo "<script>location.href='welcome.php';</script>";
}else if($myusername){
	$error = 'Your username or password is invalid';
}
$conn -> close();


?>
<!DOCTYPE html>
<html>

<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="css/style.css">
	<style type="text/css">
		.title{
		width: 60%;
		margin-left: auto;
		margin-right: auto;
		font-size: 1.4em;
		color:black;
		}
		.signin{
		margin:20px;
		}

		.content{
			width: 30%;
			margin-right: auto;
			margin-left: auto;
		}
		.class {text-align: right;
		    clear: both;
		    float:left;
		    }
		.fillinput {
			vertical-align: middle;
			display: block;margin-top: 10px; display: block;}
		.content label{
			float:left; clear:left; width:100px; text-align: right; display: block; padding-right: 10px; margin-top: 10px;
		}
		.content input{
			vertical-align: middle;
        display: block;margin-top: 10px; display: block;
        padding-bottom: 15px;
		}


	</style>

</head>


<body>
<div id="wrapper">
<?php 
include 'header.php'; ?>
<div class="signin" align="center">
		<div class="title"><h2>SIGN IN</h2></div>
		<div class="content" style="margin:30px">
			<form action = "" method="post">
				<label for="username">Email  :</label><input  type="text" name="username" class="box"><br><br>
				<label for="password">Password :</label><input  type="password" name="password" class="box"><br><br>
				<input class="submitbutton" type="submit" style="background-color: #ada9a8; padding: 5px;" value="SIGN IN"><br>
			</form>
			<br>
			<div>
				<form action="register.php" method="get">
				<input style="background-color: #f5f5f5;padding: 5px" class="submitbutton" type="submit" value="CREATE NEW ACCOUNT"><br>
			</form>
			</div>
			<div style="font-size: 11px;color: #cc0000; margin-top: 10px">
				<?php
				echo $error;?>
			</div>
			
		</div>
	</div>
<?php include 'footer.php'; ?>
</div>


</body>

</html>