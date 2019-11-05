<?php 
session_start();
$old_user = $_SESSION['valid_user'];
unset($_SESSION['valid_user']);
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
session_destroy();

?>
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
	<div style="text-align:center"><h1>Log out</h1></div>
	<?php
	if(!empty($old_user)){
		echo '<div style="text-align:center">Logged out.<br><br></div>';

	}else{
		//if they weren't logged in but came to this page somehow
		echo '<div style="text-align:center">You were not logged in, and so has not been logged out.<br><br></div>';
	}
	?>
	<div style="text-align:center" >
	<a href="index.php">Back to main page</a>
</div>
<?php include 'footer.php';
?>
</body>
</html>