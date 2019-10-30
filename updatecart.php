

<?php 
	$servername = "127.0.0.1";
	$username = "root";
	$password = "Fukua971005";
	$db = "f34ee";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $db);

	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}   
	// //echo "Connected successfully<br>";
	// $name1 = $_GET['change1'];
	// $justJavaSize = $_GET['JustJavaSize'];
	// $justJavaPrice = $_GET['JustJavaPrice'];


	// $name2 = $_GET['change2'];
	// $cafeAuLaitSize = $_GET['CafeAuLaitSize'];
	// $cafeAuLaitPrice = $_GET['CafeAuLaitPrice'];


	// $name3 = $_GET['change3'];
	// $icedCappuccinoSize = $_GET['IcedCappuccinoSize'];
	// $icedCappuccinoPrice = $_GET['IcedCappuccinoPrice'];

	echo $row['product_id'];

	if (isset($_POST['submit']) && isset($_POST['amount'][$id])) {
        $amount = intval($_POST['amount'][$id]);
    } else { 
        if(isset($_SESSION['amounts'][$id])) {
            $amount = $_SESSION['amounts'][$id];
        } else { 
            $amount = 1;
        }
    }
    if(!isset($_SESSION['amounts'])) $_SESSION['amounts'] = array();
    $_SESSION['amounts'][$id] = $amount;


?>