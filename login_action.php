<?php
session_start();
include ("connection.php");

if(isset($_POST['sub']))
{
$a = $_POST['email'];
$b = $_POST['password'];
$b=md5($b);

$sql = "SELECT * FROM register WHERE email= '$a' and password= '$b' ";
$result = mysqli_query($conn, $sql);
$rowcount=mysqli_num_rows($result);
$row = mysqli_fetch_array($result);


if($rowcount > 0)
{
	
	$_SESSION["login"]="1";
	unset($_SESSION["login_error"]);
	header("location:index.html");
}
else	
{	
	$_SESSION["login_error"] = "Please check login";
    echo "<script>alert('Please enter valid email or password');
    window.location.href = 'login_register_form.html';
    </script>";
	
}
}






?>