<header>
  <div class="topbar">
    <div class="right">
    <form action="shop.php?category=home" method="get">
    <input name="searchstring" type="text" placeholder="Search">
    <a href="<?php 
    if($_SESSION['valid_user']){
      echo 'welcome.php';
    }else{
      echo 'login.php';
    }
    ?>"><img style="width: 20px;height: 20px;vertical-align: middle;" src="img/login.png">
    <a href="cart.php"><img style="width: 30px;height: 30px;vertical-align: middle;" src="img/cart.png">
  
  </form>
  </div>
  </div>
  <!-- Header -->
  <div class="header">
       <img src="img/header2.jpg" id="img_head" alt="head" style="width: 200px;height: 70px;" class="center">
  </div>

  <!-- Top Navigation Bar-->
  <div class="nav">
        <ul>
          <li class="home"><a href="index.php">Home</a></li>
          <li class="Charms"><a href="shop.php?category=Charms">Charms</a>
            <ul>
              <li><a href='shop.php?subcat=Dangle Charms'>Dangle Charms</a></li>
              <li><a href='shop.php?subcat=Spacer Charms'>Spacer Charms</a></li>
              <li><a href='shop.php?subcat=Clips'>Clips</a></li>
            </ul>
          </li>
          <li class="Necklaces"><a href="shop.php?category=Necklaces">Necklaces</a>
            <ul>
              <li><a href='shop.php?subcat=Locket Necklaces'>Locket Necklace</a></li>
              <li><a href='shop.php?subcat=Chain Necklaces'>Chain Necklace</a></li>
            </ul>
          </li>
          <li class="Rings"><a  href="shop.php?category=Rings">Rings</a>
            <ul>
              <li><a href='shop.php?subcat=Promise'>Promise Rings</a></li>
              <li><a href="shop.php?subcat=Silver">Silver Rings</a></li>
            </ul>
          </li>
          <li class="sale"><a href="shop.php?category=Sales">Sale</a></li>
          <li class="about"><a href="about.php">About</a></li>
        </ul>
    </div>
</header>