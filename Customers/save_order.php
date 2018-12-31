<?php

$dbcon=mysqli_connect("localhost","root","");
mysqli_select_db($dbcon,"pizzademo");

if(isset($_POST['order_save']))
{
 $user_id = $_POST['user_id'];
 $item_id = $_POST['item_id'];
 $order_name = $_POST['order_name'];
 $order_price = $_POST['order_price'];
 $order_quantity = $_POST['order_quantity'];
 $order_total=$order_price * $order_quantity;
 $order_status='Pending';
 $save_order="insert into orderdetails (user_id,item_id,order_name,order_price,order_quantity,order_total,order_status,order_date) VALUE ('$user_id','$item_id','$order_name','$order_price','$order_quantity','$order_total','$order_status',CURDATE())";
 mysqli_query($dbcon,$save_order);
 echo "<script>alert('Item successfully added to cart!')</script>";				
 echo "<script>window.open('cart_items.php','_self')</script>";
}

?>
