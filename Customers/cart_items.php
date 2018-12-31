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
		extract($_SESSION);
		$qry=mysqli_query($dbcon,"SELECT * FROM users where user_email='$user_email'");
		while($query2=mysqli_fetch_assoc($qry))
		extract($query2);
		
?>		
		
<?php

	$dbcon=mysqli_connect("localhost","root","");
	mysqli_select_db($dbcon,"pizzademo");
	
	if(isset($_GET['delete_id']))
	{
		$order_id=$_GET['delete_id'];
		$qry=mysqli_query($dbcon,"DELETE FROM orderdetails WHERE order_id ='$order_id'");		
		header("Location: cart_items.php");
	}
	
	
?>

<?php
	
	if(isset($_GET['update_id']))
	{
	  $user_id=$_GET['update_id'];
	  $qry=mysqli_query($dbcon,"update orderdetails set order_status='Ordered' WHERE order_status='Pending' and user_id =$user_id");
	  echo "<script>alert('Item's successfully ordered!')</script>";			
	  echo "<script>window.open('orders.php','_self');</script>";				
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domino's Pizza</title>
	 <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

   
    
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Domino's Pizza</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li><a href="index.php"> &nbsp; <span class='glyphicon glyphicon-home'></span> Home</a></li>
					<li><a href="shop.php"> &nbsp; <span class='glyphicon glyphicon-shopping-cart'></span> Shop Now</a></li>
					<li class="active"><a href="cart_items.php"> &nbsp; <span class='fa fa-cart-plus'></span> Shopping Cart Lists</a></li>
					<li><a href="orders.php"> &nbsp; <span class='glyphicon glyphicon-list-alt'></span>  Bill of Ordered Items</a></li>
					<li><a href="view_purchased.php"> &nbsp; <span class='glyphicon glyphicon-eye-open'></span> Previous Items Ordered</a></li>
					<li><a data-toggle="modal" data-target="#setAccount"> &nbsp; <span class='fa fa-gear'></span> Account Settings</a></li>
					<li><a href="logout.php"> &nbsp; <span class='glyphicon glyphicon-off'></span> Logout</a></li>
					
                    
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <a href="#"><i class="fa fa-calendar"></i>  <?php
                            
                            $new=date('l, F d, Y');
                            echo $new; ?></a>
                        
                    </li>
					
					
                     <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php	extract($_SESSION); echo $user_email;?></a>
                        <ul class="dropdown-menu">
                            <li><a data-toggle="modal" data-target="#setAccount"><i class="fa fa-gear"></i> Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
            
			
			<div class="alert alert-default" style="color:white;background-color:#008CBA">
         <center><h3> <span class="fa fa-cart-plus"></span> Shopping Cart Lists</h3></center>
        </div>
			
			<br />
						  
						  <div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Price</th>
				  <th>Quantity</th>
				  <th>Total</th>
                  <th>Actions</th>
                 
                </tr>
              </thead>
              <tbody>

<?php
	$dbcon=mysqli_connect("localhost","root","");
	mysqli_select_db($dbcon,"pizzademo");
 
	$qry=mysqli_query($dbcon,"SELECT * FROM orderdetails where order_status='Pending' and user_id=$user_id");
	if(mysqli_num_rows($qry)>0)
	{
		while($query=mysqli_fetch_assoc($qry))
		{
			extract($query);
?>
               <tr>
                  
                 <td><?php echo $order_name; ?></td>
				 <td>$ <?php echo $order_price; ?> </td>
				 <td><?php echo $order_quantity; ?></td>
				 <td>$ <?php echo $order_total; ?> </td>
				 
				 <td>
				<center><a class="btn btn-block btn-danger" href="?delete_id=<?php echo $query['order_id']; ?>" title="click for delete" onclick="return confirm('Are you sure to remove this item?')"><span class='glyphicon glyphicon-trash'></span> Remove Item</a></center>
                  </td>
                </tr>

               <?php
		}
		
	$qry=mysqli_query($dbcon,"select sum(order_total) as totalx from orderdetails where user_id=$user_id and order_status='Pending'");
	$query=mysqli_fetch_assoc($qry);
		extract($query);
		
		echo "<tr>";
		echo "<td colspan='3' align='right'>Total Price:";
		echo "</td>";
		
		echo "<td>$ ".$totalx;
		echo "</td>";
		
		echo "<td>";
				echo "<center><a class='btn btn-block btn-success' href='?update_id=".$user_id."' ><span class='glyphicon glyphicon-shopping-cart'></span> Order Now!</a></center>";
				echo "<br>";
				echo "<center><a class='btn btn-block btn-success' href='shop.php' >Continue Order</a></center>";
		echo "</td>";
		
		echo "</tr>";
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		echo "<br />";
		echo '<div class="alert alert-default" style="background-color:#033c73;">
                       <p style="color:white;text-align:center;">
                       &copy 2016 dominos Pizza| All Rights Reserved |  Design by : Nikita Jadhav & Gauri Kumbhar

						</p>
                        
                    </div>
	</div>';
	
		echo "</div>";
	}
	else
	{
		?>
             
		

		
		
			
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Item Found ...
            </div>
        </div>
        <?php
	}
	
?>
			
			
		
					
                </div>
            </div>

           

           
        </div>
		
		
		
    </div>
    <!-- /#wrapper -->

	
	<!-- Mediul Modal -->
        <div class="modal fade" id="setAccount" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-sm">
            <div style="color:white;background-color:#008CBA" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 style="color:white" class="modal-title" id="myModalLabel">Account Settings</h2>
              </div>
              <div class="modal-body">
         
				
			
				
				 <form enctype="multipart/form-data" method="post" action="settings.php">
                   <fieldset>
					
						
                            <p>Firstname:</p>
                            <div class="form-group">
							
                                <input class="form-control" placeholder="Firstname" name="user_firstname" type="text" value="<?php  echo $user_firstname; ?>" required>
                           
							 
							</div>
							
							
							<p>Lastname:</p>
                            <div class="form-group">
							
                                <input class="form-control" placeholder="Lastname" name="user_lastname" type="text" value="<?php echo $user_lastname;?>" required>
                           
							 
							</div>
							
							<p>Address:</p>
                            <div class="form-group">
							
                                <input class="form-control" placeholder="Address" name="user_address" type="text" value="<?php echo $user_address;?>" required>
                           
							 
							</div>
							<p>Phone No:</p>
                            <div class="form-group">
							
                                <input class="form-control" placeholder="Phone No" name="user_phnno" type="text" value="<?php echo $user_phnno;?>" required>
                           
							 
							</div>
							
							<p>Password:</p>
                            <div class="form-group">
							
                                <input class="form-control" placeholder="Password" name="user_password" type="password" value="<?php echo $user_password;?>" required>
                           
							 
							</div>
							
							<div class="form-group">
							
                                <input class="form-control hide" name="user_id" type="text" value="<?php echo $user_id;?>" required>
                           
							 
							</div>
							
							
							
							
				
							
				   
				   
					 </fieldset>
                  
            
              </div>
              <div class="modal-footer">
               
                <button class="btn btn-block btn-success btn-md" name="user_save">Save</button>
				
				 <button type="button" class="btn btn-block btn-danger btn-md" data-dismiss="modal">Cancel</button>
				
				
				   </form>
              </div>
            </div>
          </div>
        </div>

</body>
</html>
