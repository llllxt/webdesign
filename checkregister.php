<?php
session_start();
include 'connect.php';
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
	echo '<script> alert("Email already exists"); </script>';
}else{
	$query = 'INSERT INTO customers (first_name,last_name,email,password,dateofbirth) VALUES ("'.$firstname .'","' . $lastname . '","' .$email. '","' .$password. '","' .$dateofbirth. '")';
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