<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
<style>
.column{
  margin-top: 50px;
  float: left;
  text-align: center;

}
.leftpart{
  width:30%;
  text-align: left;
  margin-left:100px;
  min-width: 400px;


}

.rightpart{
  width:60%;
  margin-right:30px;
  min-width: 650px;
  
  
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.wrapper{
	width:100%;
	min-width: 1800px;
	float: center; 
	display: block;
  

	
}
.red{
	color: red;
}
.button{
	background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 30px 70px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  margin: 30px 70px;
  cursor: pointer;
	

}
.green_add{
	background-color: #4CAF50;
	color: white;
	padding: 7px 30px;
	font-size: 12px;
	float: right;	
}

.grey_add{
	background-color:#e7e7e7;
	color: black;
	padding: 7px 30px;
	font-size: 12px;
	float: middle;
}

</style>
</head>
<?php  include 'header.php'; ?>
<body>
	<div style="text-align: center;"><h1> About Us </h1></div>

	
</body>

<?php include 'footer.php';  ?> 

</html>