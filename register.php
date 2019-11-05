<?php
session_start();
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

	<form class="inputform" method="post" action="checkregister.php" onsubmit="chkall();">
		
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
			Already has an account?<a href="login.php" style="text-decoration: blue underline; color: blue;">Sign in</a>
		</p>
  </div>
  
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="javascript/validator.js"></script>

</body>
</html>

