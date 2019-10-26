<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
<style>
  .dropdown{  
    background:#fafdfe;  
    height:28px;  
    width:auto;  
    line-height:28px;  
    border:1px solid #9bc0dd;  
    -moz-border-radius:2px;  
    -webkit-border-radius:2px;  
    border-radius:2px;  
}
a{
    color:black;
    text-decoration-color: none;
    text-decoration: none;
  }
.container {
  display: flex;
  max-width: 100%;
  margin-left: auto;
  margin-right: auto;
}
.row {
  position: relative;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  -ms-flex-direction: row;
  flex-direction: row;
  -webkit-box-pack: inherit;
  -ms-flex-pack: inherit;
  justify-content: inherit;
  -webkit-box-align: stretch;
  -ms-flex-align: stretch;
  align-items: stretch;
  width: 100% !important;
  padding: 0;
  margin-left: auto;
  margin-right: auto;
 
}
.product-block{
  width:33%;
  height: 33%;
  display: inline-block;
}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 90%;
}
.textcenter{
  text-align: center;
  margin-left: auto;
  margin-right: auto;
  width: 80%;
}
</style>
</head>
<body>
<div class="wrapper">
  <?php
    $conn = new mysqli("127.0.0.1", "root", "Fukua971005","f34ee");
    if($conn->connection_error){
      include_once("error.php");
      exit();
    }
    include 'header.php';
    $category = $_GET['category'];
    if($category){
      $_SESSION['category'] = $category;
    }
    include 'slideshow.php';  
 ?>

<div class="filterbar"  style="width:100%; margin-left: auto;margin-right: auto; float: left;">


<?php
if(isset($_GET['color'])){
  $color = $_GET['color'];
}
if(isset($_GET['price'])){
  $price = $_GET['price'];
}
if(isset($_GET['theme'])){
  $theme = $_GET['theme'];
}
echo '
<div class="filter">   
<form>  
      <select name="color" class="dropdown" id="color" onchange="this.form.submit()">
        <option value="all"'.($color=="all"?' selected' : '').'>COLOR</option>
        <option value="Silver"'.($color=="Silver"?' selected' : '').'>Silver</option>
        <option value="Golden"'.($color=="Golden"?' selected' : '').'>Golden</option>
        <option value="Clear"'.($color=="Clear"?' selected' : '').'>Clear</option>
        <option value="Multi"'.($color=="Multi"?' selected' : '').'>Multicolor</option>
      </select>
 </div>
 <div class="filter" > 
      <select name="price" id="price" class="dropdown" onchange="this.form.submit()">
      <option value="all" '.($price=="all"?' selected' : '').'>PRICE</option>
      <option value="1"'.($price=="1"?' selected' : '').'>1-50</option>
      <option value="50"'.($price=="50"?' selected' : '').'>50-100</option>
      <option value="100"'.($price=="100"?' selected' : '').'>100-150</option>
      <option value="150"'.($price=="150"?' selected' : '').'>150-200</option>
      <option value="250"'.($price=="200"?' selected' : '').'>200+</option>
    </select>
 </div>
 <div class="filter" > 
  
      <select name="theme" id="theme" class="dropdown" onchange="this.form.submit()">
        <option value="all" '.($theme=="all"?' selected' : '').'>THEME</option>
        <option value="Hobbies & Passions"'.($theme=="Hobbies & Passions"?' selected' : '').'>Hobbies &amp; Passions</option>
        <option value="Fairytale"'.($theme=="Fairytale"?' selected' : '').'>Fairytale</option>
        <option value="Alphabet & Numbers"'.($theme=="Alphabet & Numbers"?' selected' : '').'>Alphabet &amp; Numbers</option>
        <option value="Flowers & Nature"'.($theme=="Flowers & Nature"?' selected' : '').'>Flower &amp; nature</option>
        <option value="Love & Romance"'.($theme=="Love & Romance"?' selected' : '').'>Love &amp; Romance</option>
      </select> 
 </div>
  </form>
</div>
<div>
  <p></p>
<br>
</div>
';
    $pageSize = 6;
    $page = isset($_GET['page'])?$_GET['page']:1;
    //calculate offset through page and pagesize
    $offset = $pageSize*($page-1);
    
    //search function implementation
    $query = 'SELECT COUNT(id) AS totalrows FROM products';
    echo $_GET['searchstring'];
    if($_SESSION['category'] != "home"){
      $query = 'SELECT COUNT(id) AS totalrows FROM products WHERE category="'.$_SESSION['category'].'" ';
    }else if(isset($_GET['searchstring'])){
      $query = $query . ' WHERE name LIKE "%' . $_GET['searchstring'] .'%"';
      echo $query;    
    }
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $result->free();
    
    //filter in product page
    if($_SESSION['category'] != 'home'){
      $query = 'SELECT * FROM products WHERE category="'.$_SESSION['category'].'" ';
    if($_GET['color'] && $_GET['color'] != "all"){
      $query=$query . ' AND color = "' .$_GET['color'] .'"';
    }
    if($_GET['theme'] && $_GET['theme'] != "all"){
      $query = $query. ' AND theme = "' . $_GET['theme'] . '"';
    }
    if($_GET['price'] && $_GET['price'] != "all"){
      $max = (int)$_GET['price']+50;
      $query = $query . ' AND price*discount BETWEEN ' . (int)$_GET['price'] . ' AND ' .$max;
    }
    }else if(isset($_GET['searchstring'])){
      $query ='SELECT * FROM products WHERE name LIKE "%' . $_GET['searchstring'] .'%"';
      echo $query;
    }
    //filter in home page
    else{
      $query = 'SELECT * FROM products';
    if($_GET['theme'] && $_GET['theme'] != "all"){
      if(! ($_GET['price'] && $_GET['price'] != "all")){
        $query = $query. ' WHERE theme = "' . $_GET['theme'] . '"';
      }else{
        $query = $query. ' AND theme = "' . $_GET['theme'] . '"';
      }
    }
    if($_GET['price'] && $_GET['price'] != "all"){
      $max = (int)$_GET['price']+50;
      $query = $query . ' WHERE price*discount BETWEEN ' . (int)$_GET['price'] . ' AND ' .$max;
    }
    }
    
    // foreach ($_GET as $param_name => $param_val){
    //   if($param_name == 'color' || $param_name == 'theme'){
    //     $query = $query . ' AND '; 
    //     $query = $query . $param_name . '="' . $param_val . '"';  
    //     echo $query;
    //   }else if($param_name == 'price'){
    //     $max = (int)$param_val+50;
        
    //     $query = $query . $param_name . ' BETWEEN ' . (int)$param_val . ' AND ' .$max;
    //   }
    // }
    $query = $query . ' LIMIT '.$offset.','.$pageSize;
    $result = $conn->query($query);
    if($result){
      $num_rows = mysqli_num_rows($result);
      if($num_rows > 0){
       echo '
       <div class="container">
        <div class="row" style="width:100%">
        
       ';
       while($row = $result->fetch_assoc()){
        $product_id = $row['id'];
        $product_name = $row['name'];
        $product_price = $row['price'];
        $product_image = $row['image1'];
        $product_discount = $row['discount'];
        echo'<div class="product-block">';
        include 'product.php';
        echo '</div>';
       }
       $result->free();
       echo '
       </div>
       </div>
       ';
       echo '
       <div class="row>
       <div class="pagination shop_pagination">';
       $num_pages = floor($totalrows/6)+1;
       //the first page has no previous page
       if($num_pages > 1){
        if($page>0){
          echo'
          <a href="shop.php?page='.($page-1).'">prev</a>';
          echo '&nbsp;';
        }
        // the last page has no next page
        if($page<$num_pages){
          echo '<a href="shop.php?page='.($page+1).'">next</a>';
          echo '&nbsp;';
        }     
    }
    echo '</div>
    </div>';
        }
      }
    
    $conn -> close();
 ?>
        

<script type="text/javascript" src='javascript/slide.js'></script>
<script type="text/javascript" src='javascript/filter.js'></script>
</div>
</body>

<?php include 'footer.php'; ?>

</html>