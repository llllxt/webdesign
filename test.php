<html>
<head>
<title>Country</title>
</head>
<body>
<form>  
      <select name="color" id="color" onchange="this.form.submit()">
        <option value="0">COLOR</option>
        <option value="1">Pink</option>
        <option value="2">Blue</option>
        <option value="3">Red</option>
        <option value="4">Multicolor</option>
      </select>
    </form>
<?php
   if(isset($_GET["color"])){
       $country=$_GET["color"];
       echo "select country is => ".$country;
   }
?>
</body>
</html>