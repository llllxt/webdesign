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
    // session_start();
    $conn = new mysqli("127.0.0.1", "root", "Fukua971005","f34ee");
    if($conn->connection_error){
      include_once("error.php");
      exit();
    }
    include 'header.php';
    $category = $_GET['category'];
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
if(isset($GET['theme'])){
  $theme = $_GET['theme'];
}
echo '
<div class="filter">   
<form>  
      <select name="color" class="dropdown" id="color" onchange="this.form.submit()">
        <option value="0" disabled selected'.($color=="0"?' selected' : '').'>COLOR</option>
        <option value="1"'.($color=="1"?' selected' : '').'>Pink</option>
        <option value="2"'.($color=="2"?' selected' : '').'>Blue</option>
        <option value="3"'.($color=="3"?' selected' : '').'>Red</option>
        <option value="4"'.($color=="4"?' selected' : '').'>Multicolor</option>
      </select>
    </form>
 </div>
 <div class="filter" > 
 <form>   
      <select id="price" class="dropdown" onchange="this.form.submit()">
      <option value="0" disabled selected'.($price=="0"?' selected' : '').'>PRICE</option>
      <option value="1"'.($price=="1"?' selected' : '').'>0-50</option>
      <option value="2"'.($price=="2"?' selected' : '').'>50-100</option>
      <option value="3"'.($price=="3"?' selected' : '').'>100-150</option>
      <option value="4"'.($price=="4"?' selected' : '').'>150-200</option>
      <option value="5"'.($price=="5"?' selected' : '').'>200+</option>
    </select>
  </form>
 </div>
 <div class="filter" > 
 <form>    
      <select id="theme" class="dropdown" onchange="this.form.submit()">
        <option value="0" disabled selected'.($theme=="0"?' selected' : '').'>THEME</option>
        <option value="1"'.($theme=="1"?' selected' : '').'>Career Aspiration</option>
        <option value="2"'.($theme=="2"?' selected' : '').'>Animals &amp; Pets</option>
        <option value="3"'.($theme=="3"?' selected' : '').'>Firytale</option>
        <option value="4"'.($theme=="4"?' selected' : '').'>Flower &amp; nature</option>
        <option value="5"'.($theme=="5"?' selected' : '').'>Love &amp; Romance</option>
      </select>
    </form>
 </div>
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
    // $pageIndex = 0;

    $query = 'SELECT COUNT(id) AS totalrows FROM products WHERE category="'.$category.'" ';

    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $result->free();

    $query = 'SELECT * FROM products WHERE category="'.$category.'" ';


    foreach ($_GET as $param_name => $param_val){
      if($param_name == 'color' || $param_name == 'theme'){
        $query = $query . ' AND (';        
        foreach($param_val as $val){          
            $query = $query . $param_name . '="' . $val . '"';         
        }
      }else if($param_name == 'price'){
        $query = $query . $param_name . 'BETWEEN' . $val[0] . 'AND' .$val[1];
      }
    }

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

