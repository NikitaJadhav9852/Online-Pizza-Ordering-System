<?php
session_start();
if(!$_SESSION['user_email'])
{
    header("Location: ../index.php");
}
?>
<?php

$dbcon=mysqli_connect("localhost","root","");
mysqli_select_db($dbcon,"pizzademo");

if(isset($_POST['user_save']))
{
	$user_firstname=$_POST['user_firstname'];
	$user_lastname=$_POST['user_lastname'];
	$user_address=$_POST['user_address'];
	$user_password=$_POST['user_password'];
	$user_phnno=$_POST['user_phnno'];
	$user_id=$_POST['user_id'];
 
 
$uprofile="update users set user_password='$user_password', user_firstname='$user_firstname', user_lastname='$user_lastname', user_address='$user_address', user_phnno='$user_phnno' where user_id='$user_id'";
    
	if(mysqli_query($dbcon,$uprofile))
    {
		echo "<script>alert('Account successfully updated!')</script>";
        echo"<script>window.open('index.php','_self')</script>";
    }
}
?>