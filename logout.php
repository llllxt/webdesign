<?php 
session_start();
$old_user = $_SESSION['valid_user'];
unset($_SESSION['valid_user']);
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
session_destroy();

?>
<html>
<body>
	<h1>Log out</h1>
	<?php
	if(!empty($old_user)){
		echo 'Logged out.<br>';

	}else{
		//if they weren't logged in but came to this page somehow
		echo 'You were not logged in, and so hae not been logged out.<br>';
	}
	?>
	<a href="index.php">Back to main page</a>
</body>
</html>