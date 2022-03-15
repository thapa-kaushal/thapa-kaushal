<?php
include "connection.php";
$name=$_POST['name'];
$email=$_POST['email'];
$password = md5($_POST['password']);
$cpassword = md5($_POST['cpassword']);
$gender=$_POST['gender'];
// print_r($name);
// print_r($email);
// print_r($password);
// print_r($cpassword);
// print_r($gender);

$slquery1 = "SELECT 1 FROM register WHERE email = '$email'";
    // $slquery2 = "SELECT 1 FROM register WHERE mobile = '$mobile'";
    $selectresult1 = mysqli_query($conn,$slquery1);
    // $selectresult2 = mysqli_query($conn,$slquery2);
    if(mysqli_num_rows($selectresult1)>0)
    {
       echo "<script>alert('email already exists');</script>";
       header("location:/login_register_form.php");
   }
//    elseif(mysqli_num_rows($selectresult2)>0)
//     {
//        echo "<script>alert('mobile already exists');</script>";
//    } 
   elseif($password != $cpassword){
       echo "<script>alert('passwords doesn't match');</script>";
   }
   else{
      $sql = "INSERT INTO register(name,email,password,gender)VALUES('$name','$email','$password','$gender')";
      $result=mysqli_query($conn,$sql);

      if($result){
            //  $msg = "User Created Successfully.";
       echo "<script>alert('User Created Successfully');</script>";
       header("location:login_register_form.html");
         
   }
}




// include 'connection.php';


?>
