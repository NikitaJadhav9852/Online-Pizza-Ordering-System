<?php
session_start();
if(!$_SESSION['admin_username'])
{
    header("Location: ../index.php"); //redirect to login page to secure the welcome page without login access.
}
?>
<?php

$dbcon=mysqli_connect("localhost","root","");
mysqli_select_db($dbcon,"pizzademo");

if(isset($_POST['item_save']))
{
		$item_name = $_POST['item_name'];
		$item_price = $_POST['item_price'];

		$check_item="select * from items WHERE item_name='$item_name'";
 
		$run_query=mysqli_query($dbcon,$check_item);
  
		if(mysqli_num_rows($run_query)>0)
		{
			echo "<script>alert('Item is already exist, Please try another one!')</script>";
			echo"<script>window.open('index.php','_self')</script>";
			exit();
		}
	
	$imgFile = $_FILES['item_image']['name'];
	$tmp_dir = $_FILES['item_image']['tmp_name'];
	
	$upload_dir = 'item_images/';		
	$upload_dir1 ='item_images/';
	
	move_uploaded_file($tmp_dir,$upload_dir.$imgFile);
	$saveitem="insert into items (item_name,item_price,item_image,item_date) VALUE
	('$item_name','$item_price','$imgFile',CURDATE())";
	mysqli_query($dbcon,$saveitem);
	echo "<script>alert('Data successfully saved!')</script>";				
	echo "<script>window.open('items.php','_self')</script>";
}
?>