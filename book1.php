<html>
<head>
<title>BUY</title>
<style>
*{font-family:sans-serif;}
<!--f1{
display:flex;align-items:center;justify-content:center;
}-->
#f1{
background-color:white;width:45%;border-radius:5%;
margin:auto;
margin-top:50px;
}
.a1{
height:30px;width:200px;
}
label{
font-size:20px;margin-left:5px;
}
#s1{
height:35px;width:150px;background-color:lightgreen;font-weight:bold;border-color:#FF8C00;font-size:17px;
}
#p1{
color:red;
}
<?php
$conn = new mysqli("localhost","root","","Mobile_store");
if($conn -> connect_error){
echo "not connected successfully";
}
else
echo "connected successfully" ;
?>
</style>
</head>
<body style="background-image:url('https://static.vecteezy.com/system/resources/previews/001/370/039/non_2x/online-shopping-concept-with-mobile-phone-free-vector.jpg')">
<div id="f1">
<form style="margin-left:10%;padding:20px;background-color:whitesmoke;" method="get">
<center><h1>ORDER FORM</h1></center>
<label><b>Name</b></label><br><br>
<input type="text" name="reg" class="a1" placeholder="Name"><br><br>
<label><b>Phone Numer</b></label><br><br>
<input type="number" name="dep" placeholder="Phone Numer" class="a1" id="d1" onkeyup="depi();"><BR><br>
<label><b>Address</b></label><br><br>
<input type="text" name="reg1" class="a1" placeholder="Address"><br><br>
<p id="p1" ></p>
<br><br>
<center><input type="submit" value="Place Order" name="submit" id="s1" onclick="tick()"></center>
</form>
</div>
<?php
if(isset($_GET["submit"])){
          session_start();
          $name=$_GET["reg"];
         
          $ph=$_GET["dep"];
		  $add=$_GET["reg1"];
          $sql= $conn->prepare("Insert into book(name,address,phone_number) VALUES (?,?,?)");
          $sql->bind_param("sss",$name,$add,$ph);
          $sql->execute();
  
}
?>

<script>
function tick()
{
window.open('Payment.php');

}
</script>
</body>
</html>



