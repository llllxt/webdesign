<?php
session_start();
$conn = new mysqli("127.0.0.1", "root", "Fukua971005","f34ee");
    if($conn->connection_error){
      include_once("error.php");
      exit();
    }
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$dateofbirth = $_POST['dateofbirth'];
$email = $_POST['email'];
$password_1 = $_POST['password_1'];
$password_2 = $_POST['password_2'];
if($password_1 != $password_2){
  echo "Sorry passwords do not match";
  exit;
}
$password = md5($password_1);
$query = 'SELECT * FROM customers WHERE email="' . $email . '"';
$result = $conn -> query($query);
$row = $result -> fetch_assoc();
if($row){
	echo 'Email already exists';
}else{
	$query = 'INSERT INTO customers (first_name,last_name,email,password,dateofbirth) VALUES ("'.$firstname .'","' . $lastname . '","' .$email. '","' .$password. '","' .$dateofbirth. '")';
	echo $query;
	$result = $conn -> query($query);
  if(!$result){
  }else{
    $_SESSION['valid_user'] = $email;
    $_SESSION['success'] = "You are now logged in";
    echo 'Welcome ' .$firstname. '. You are now registered';
    echo "<script>location.href='login.php';</script>";
  }
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
  <link rel="stylesheet" type="text/css" href="css/style.css"> 
	<style type="text/css">
  .content {
    width: 50%;
    margin-right: auto;
    margin-left: auto;
  }
  .inputform{
    width: 70%;
    margin-right: auto;
    margin-left: auto;
  }
  .input-group{
    width: 80%;
    margin-left: auto;
    margin-right: auto;
  }
  .input-group label{
    float:left; clear:left; width:150px; text-align: right; display: block; padding-right: 10px; margin-top: 10px;
  }
  .input-group input{
    vertical-align: middle;
        display: block;margin-top: 10px; display: block;
        padding-bottom: 15px;
        margin-right: auto;
        margin-left: auto;
  }
  .submitbutton{
        padding: 5px;
        color: black;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
       }
  


	</style>
</head>
<body>
  <?php include 'header.php'; ?>
  <div class="content">
	<div class="header">
		<h2>CREATE NEW ACCOUNT</h2>
	</div>

	<form class="inputform" method="post" action="register.php" onsubmit="chkall();">
		
		<div  class = "input-group">
			<label for="firstname">First Name</label>
			<input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>" Required>
		</div>
		<div  class = "input-group">
			<label>Last Name</label>
			<input type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>" Required>
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" id="email" name="email" value="<?php echo $email;?>" Required>
		</div>
		<div class="input-group">
			<label>Date of Birth</label>
			<input type="date" id="dateofbirth" name="dateofbirth" Required>
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" id="password_1" name="password_1" Required>
		</div>
		<div class="input-group">
			<label>Confirm Password</label>
			<input type="password" id="password_2" name="password_2" Required>
		</div>
    <br><br>
		<div class="input-group">
			<input type="submit" class="submitbutton" name="reg_user" value="Register" style="background-color: #f5f5f5;padding: 5px">
		</div>
    <br><br>
  </form>
    <div class="input-group">
		<p style="width: 90%; margin-left:0;">
			Already has an account?<a href="login.php">Sign in</a>
		</p>
  </div>
  
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="javascript/validator.js"></script>

</body>
</html>

