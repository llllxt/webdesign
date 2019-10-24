<?php
$conn = new mysqli("127.0.0.1", "root", "Fukua971005","f34ee");
if($conn->connection_error){
	include_once("error.php");
	exit();
}
$query = 'SELECT img1,img2,img3 FROM banner WHERE category="'.$category.'"';
$result = $conn -> query($query);
$row = $result -> fetch_assoc();
$img1 = $row['img1'];
$img2 = $row['img2'];
$img3 = $row['img3'];

echo'
<div class="slide-container">
    <div class="slide">
      <img src="'.$img1.'"style="width:100%;height:500px">
    </div>
    <div class="slide">
      <img src="'.$img2.'"style="width:100%;height:500px">
    </div>
    <div class="slide">
      <img src="'.$img3.'"style="width:100%;height:500px">
    </div>
  </div>
  <br>
';

?>

