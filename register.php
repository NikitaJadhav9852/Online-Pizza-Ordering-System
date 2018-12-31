<?php
session_start();
?>

<?php
$dbcon=mysqli_connect("localhost","root","");
mysqli_select_db($dbcon,"pizzademo");

	if(isset($_POST['register']))
	{
		$user_firstname = $_POST['fname'];
		$user_lastname = $_POST['lname'];
		$user_address = $_POST['uaddress'];
		$user_email = $_POST['uemail'];
		$user_password = $_POST['upassword'];
		$user_phnno = $_POST['uphnno'];
		
		$check_user="select * from users WHERE user_email='$user_email'";
		
		$run_query=mysqli_query($dbcon,$check_user);

			if(mysqli_num_rows($run_query)>0)
			{
				echo"<script>alert('Customer is already exist, Please try another one!')</script>";
				echo"<script>window.open('index.php','_self')</script>";
				exit();
			}

		$saveaccount="insert into users (user_email,user_password,user_firstname,user_lastname,user_address,user_phnno) VALUE ('$user_email','$user_password','$user_firstname','$user_lastname','$user_address','$user_phnno')";
		mysqli_query($dbcon,$saveaccount);
		echo "<script>alert('Data successfully saved, You may now login!')</script>";				
		echo "<script>window.open('index.php','_self')</script>";
	}
?>