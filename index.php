<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
<style type="text/css">
  .text{
    text-decoration: none;
    color: black;
    font-weight: bold;
  }
   .dropdown{     
    height:30px;  
    width:auto;  
    line-height:28px;  
    border:1px solid #9bc0dd;  
    -moz-border-radius:2px;  
    -webkit-border-radius:2px;  
    border-radius:2px; 
    font-size: 1.2em; 

   }
   .filter{
    width: 80%;
    margin-left: auto;
    margin-right: auto;
   }
   .submitbutton{
    border: 1px solid;
    color: black;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
   }
  
</style>
</head>

<body>
<div id="wrapper">
 <?php 
include 'header.php'; ?>
  <!-- Slideshow -->

<?php 
$_SESSION['category'] = "home";
$_SESSION['subcat'] = 0;
$_SESSION['searchstring'] = 0;
include 'slideshow.php';?>

  <!-- New Arrivals-->
  <h2 style="text-align: center;">New Arrivals</h2>
  <div class="new-arrivals" style="margin-bottom: 50px">
    <table style="width: 80%;margin-left: auto;margin-right: auto;">
      <tr>
        <td><a href="shop.php?category=Charms">
          <img src ="img/new1.jpg" style="width: 350px; height: 450px"></td>
        <td><a href="shop.php?category=Necklaces">
          <img src ="img/new2.jpg" style="width: 350px; height: 450px"></td>
        <td><a href="shop.php?category=Rings">
          <img src ="img/new3.jpg" style="width: 350px; height: 450px"></td>
      </tr>

      <tr class="label">
        <td align="center" height="50"><a class="text" href="shop.php?category=Charms">Charms</td>
        <td align="center" height="50"><a class="text" href="shop.php?category=Necklaces">Necklaces</td>
        <td align="center" height="50s"><a class="text" href="shop.php?category=Rings">Rings</td>
      </tr>
    </table>

  </div>

  <!-- Need Help-->
  <h2 align="center">Need help finding that perfect gift?</h2>
  <div class="needhelp" align="center" style="width:50%; margin-left: auto;margin-right: auto;">
    
     
    
<?php
if(isset($_GET['price'])){
  $price = $_GET['price'];
}
if(isset($_GET['theme'])){
  $theme = $_GET['theme'];
}
echo '
<form action="shop.php?category=home & price='.$price.' & theme='.$theme.'" method="GET">  
 <div class="filter"> 
      <select name="price" id="price" class="dropdown">
      <option value="all" '.($price=="all"?' selected' : '').'>SELECT A PRICE RANGE</option>
      <option value="1"'.($price=="1"?' selected' : '').'>1-50</option>
      <option value="50"'.($price=="50"?' selected' : '').'>50-100</option>
      <option value="100"'.($price=="100"?' selected' : '').'>100-150</option>
      <option value="150"'.($price=="150"?' selected' : '').'>150-200</option>
      <option value="250"'.($price=="200"?' selected' : '').'>200+</option>
    </select>
   <br><br>
      <select name="theme" id="theme" class="dropdown">
        <option value="all" '.($theme=="all"?' selected' : '').'>SELECT A THEME</option>
        <option value="Hobbies & Passions"'.($theme=="Hobbies & Passions"?' selected' : '').'>Hobbies &amp; Passions</option>
        <option value="Fairytale"'.($theme=="Fairytale"?' selected' : '').'>Fairytale</option>
        <option value="Alphabet & Numbers"'.($theme=="Alphabet & Numbers"?' selected' : '').'>Alphabet &amp; Numbers</option>
        <option value="Flowers & Nature"'.($theme=="Flowers & Nature"?' selected' : '').'>Flower &amp; nature</option>
        <option value="Love & Romance"'.($theme=="Love & Romance"?' selected' : '').'>Love &amp; Romance</option>
      </select> 
 </div>
 <br><br>
    <input class="submitbutton" type="submit" value="View All"></input>
 <form>
';
?>

  </div>

  <script type="text/javascript" src='javascript/slide.js'></script>
  <script type="text/javascript" src='javascript/filter.js'></script>
<?php include 'footer.php'; ?>
</div>
</body>

</html>
