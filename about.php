<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
<style>

/* Container holding the image and the text */
.container {
  position: relative;
  margin-bottom: 100px;

}

/* Bottom right text */
.text-block {
  position: absolute;
  bottom: -20px;
  right: 20px;
  background-color: #FFB6C1;
  color: white;
  padding-left: 20px;
  padding-right: 20px;
  margin-left:20px;
  font-family: 'Lato', sans-serif; 

}

.text1{
text-align: center;
position: relative;
margin-top:100px;
margin-bottom:50px;

}


.image4 {
  position: absolute;
  top: 0px;
  left: 1050px;
  width:400px;
}
.img-content ul{
	width:auto; 
	margin:0 auto; 
	padding:0; 
	text-align:center;
}
.img-content ul li{
	display:inline-block;
}

.img-content ul li img{
	display: block;
	width:250px; 
	height:250px; 
	padding:20px ;
}

</style>
</head>
<?php  include 'header.php'; ?>
<body>
	
	<div style="text-align: center;">
		<h1> About Us </h1>
	</div>

	<div class="container">
		<img src="img/about1.jpg" alt="about1" style="width:100%;">
  		<div class="text-block"> 
    		<h3>Phoebe, manufactures and markets hand-finished and contemporary jewellery made from high-quality materials at affordable prices.</h3>
  		</div>
	</div>

	<div>
		<h1 class="text1">We give a voice to people's love</h1>
		<div class="img-content">
			<ul>
			<li><img src="img/about2.jpg" ></li>
			<li><img src="img/about3.jpg" ></li>
			<li><img src="img/about4.jpg" ></li>
		</ul>
		</div>
	</div>

	<div style="background-color: pink;">
		<h1 class="text1"><br>A university of jewellery and opportunities for self-expression</h1>
		<div class="img-content">
			<ul>
				<li><img src="img/about6.jpg" ></li>
				<li><img src="img/about8.jpg" ></li>
				<li><img src="img/about7.jpg" ></li>
			</ul>
		</div>
	</div>


</body>

<?php include 'footer.php';  ?> 

</html>