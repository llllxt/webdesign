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
.filter{
  display: inline-block;
  width: auto;
  border: none;
}

</style>
</head>
<body>
<div class="wrapper">
<a name="top"></a>
  <?php
   include 'connect.php';
    include 'header.php';
    $category = $_GET['category'];
   
    if($category){
      $_SESSION['category'] = $category;
      $_SESSION['subcat'] = 0;
      $_SESSION['searchstring']  = 0;
    }
     
    $subcat = $_GET['subcat'];
    if($subcat){
      $_SESSION['subcat'] = $subcat;
      $_SESSION['category'] = 0;
      $_SESSION['searchstring'] =0;
    }
    $searchstring = $_GET['searchstring'];
    if($searchstring){
      $_SESSION['searchstring'] = $searchstring;
      $_SESSION['category'] = home;
      $_SESSION['subcat'] = 0;
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
if(isset($_GET['sort'])){
  $sort = $_GET['sort'];
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

  <div class="filter">
     <select name="sort" id="sort" class="dropdown" onchange="this.form.submit()">
        <option value="all" '.($sort=="all"?' selected' : '').'>Sort by</option>
        <option value="price" '.($sort=="price"?' selected' : '').'>PRICE</option>
        <option value="discount" '.($sort=="discount"?' selected' : '').'>DISCOUNT</option>
     </select>
 </div>
  </form>
</div>
<div>
  <p></p>
<br>
</div>
';
    // $pageSize = 6;
    // $page = isset($_GET['page'])?$_GET['page']:1;
    // //calculate offset through page and pagesize
    // $offset = $pageSize*($page-1);
    
    // //search function implementation
    // $query = 'SELECT COUNT(id) AS totalrows FROM products';
    // if($subcat){
    //   $query = 'SELECT COUNT(id) AS totalrows FROM products WHERE sub_category="'.$_SESSION['subcat'].'" ';
    // }else{
    //     if($_SESSION['category'] != "home"){
    //     $query = 'SELECT COUNT(id) AS totalrows FROM products WHERE category="'.$_SESSION['category'].'" ';
    //     }else if(isset($_GET['searchstring'])){
    //     $query = $query . ' WHERE name LIKE "%' . $_SESSION['searchstring'] .'%"';
    // }
    // }
  
    // $result = $conn->query($query);
    // $row = $result->fetch_assoc();
    // $result->free();

    
    function subfilter($query){    
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
      if($_GET['sort'] && $_GET['sort'] == "price"){
        $query .= ' ORDER BY price*discount ASC';
      }else if($_GET['sort'] == "discount"){
        $query .= ' ORDER BY discount ASC';
      }
      return $query;
    }

    function mainfilter($query){
      if($_GET['price'] && $_GET['price'] != "all"){
        $max = (int)$_GET['price']+50;
        $query = $query . ' WHERE price*discount BETWEEN ' . (int)$_GET['price'] . ' AND ' .$max;
        }
      if($_GET['theme'] && $_GET['theme'] != "all"){
          if(! ($_GET['price'] && $_GET['price'] != "all")){
            $query = $query. ' WHERE theme = "' . $_GET['theme'] . '"';
          }else{
            $query = $query. ' AND theme = "' . $_GET['theme'] . '"';
          }
        }
      if($_GET['color'] && $_GET['color'] != "all"){
        $query .= ' AND color = "' .$_GET['color'] . '"';
      }
      if($_GET['sort'] && $_GET['sort'] != "all"){
        $query .= ' ORDER BY price ASC';
      }else if($_GET['sort'] == "discount"){
        $query .= ' ORDER BY discount ASC';
      }
        return $query;
      
    }

    //subcategory
    if($_SESSION['subcat']){
      $query = 'SELECT * FROM products WHERE sub_category="'.$_SESSION['subcat'].'" ';
      $query = subfilter($query);
    }
    else{
      //choose main category
      if($_SESSION['category'] && $_SESSION['category'] != 'home'){
          if($_SESSION['category'] == 'Sales'){
            $query = 'SELECT * FROM products WHERE discount < 1';
          }else{
            $query = 'SELECT * FROM products WHERE category="'.$_SESSION['category'].'" ';
          }  

          $query = subfilter($query);       
     }

      //search from home page
      else if($_SESSION['searchstring']){
        $query ='SELECT * FROM products WHERE name LIKE "%' . $_SESSION['searchstring'] .'%"';
        $query = subfilter($query);
      }
      //filter from homepage 
      else if($_SESSION['category'] == 'home'){
        $query = 'SELECT * FROM products';            
        $query = mainfilter($query);
    }
   
    }

    
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
       
        }
      }
    
    $conn -> close();
 ?>
        

<a href="#top"><img class="center"; style="width: 100px;height: 70px; " src="img/backtotop.png"></a>
<script type="text/javascript" src='javascript/slide.js'></script>
<script type="text/javascript" src='javascript/filter.js'></script>
</div>
</body>

<?php include 'footer.php'; ?>

</html>