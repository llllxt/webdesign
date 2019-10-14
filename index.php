<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<div id="wrapper">
<?php include 'header.php'; ?>
  <!-- Slideshow -->
  <div class="slide-container">
    <div class="slide">
      <img src="img/slide1.jpg" style="width:100%">
    </div>
    <div class="slide">
      <img src="img/slide2.jpg" style="width:100%">
    </div>
    <div class="slide">
      <img src="img/slide3.jpg" style="width:100%">
    </div>
  </div>
  <br>

  <!-- New Arrivals-->
  <h2 style="text-align: center;">New Arrivals</h2>
  <div class="new-arrivals" style="margin-bottom: 50px">
    <table style="width: 80%;margin-left: auto;margin-right: auto;">
      <tr>
        <td><img src ="img/new1.jpg" style="width: 350px; height: 500px"></td>
        <td><img src ="img/new2.jpg" style="width: 350px; height: 500px"></td>
        <td><img src ="img/new3.jpg" style="width: 350px; height: 500px"></td>
      </tr>

      <tr class="label">
        <td align="center" height="50">Charms</td>
        <td align="center" height="50">Necklaces</td>
        <td align="center" height="50s">Rings</td>
      </tr>
    </table>

  </div>

  <!-- Need Help-->
  <h2 align="center">Need help finding that perfect gift?</h2>
  <div class="needhelp" align="center" style="width:50%; margin-left: auto;margin-right: auto;">
    <div class="custom-select" style="width:200px;border: 1px solid">
     
    <select id="price">
      <option value="0">Select price range:</option>
      <option value="1">0-50</option>
      <option value="2">50-100</option>
      <option value="3">100-150</option>
      <option value="4">150-200</option>
      <option value="5">200+</option>
    </select>
    </div>
    <div class="custom-select" style="width:200px;border: 1px solid">
      
      <select id="theme" >
        <option value="0">Select theme:</option>
        <option value="1">Career Aspiration</option>
        <option value="2">Animals &amp; Pets</option>
        <option value="3">Firytale</option>
        <option value="4">Flower &amp; nature</option>
        <option value="5">Love &amp; Romance</option>
      </select>
    </div>
    <br><br>
    <button>View All</button>
  </div>
  <script type="text/javascript" src='javascript/slide.js'></script>
  <script type="text/javascript" src='javascript/filter.js'></script>
<?php include 'footer.php'; ?>

</div>

</body>
</html>
