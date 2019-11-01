<?php
include 'connect.php';
if($subcat){
$query = 'SELECT img1,img2,img3 FROM banner WHERE category="subcat"';

}else{
$query = 'SELECT img1,img2,img3 FROM banner WHERE category="'.$_SESSION['category'].'"';

}
$result = $conn -> query($query);
$row = $result -> fetch_assoc();
$img1 = $row['img1'];
$img2 = $row['img2'];
$img3 = $row['img3'];
echo'
<div class="slide-container" style="min-width:500px">
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

