<?php
session_start();
if(!$_SESSION['admin_username'])
{
    header("Location: ../index.php");
}
?>

<?php
	
	$dbcon=mysqli_connect("localhost","root","");
	mysqli_select_db($dbcon,"pizzademo");
	
	if(isset($_GET['delete_id']))
	{
		$delete_id=$_GET['delete_id'];
		$res=mysqli_query($dbcon,"DELETE FROM users WHERE user_id ='$delete_id'");// or die("failed".mysqli_error());	
		header("Location: customers.php");
	}

?>

<?php

	$dbcon=mysqli_connect("localhost","root","");
	mysqli_select_db($dbcon,"pizzademo");
	
	if(isset($_GET['reset_id']))//finish order button
	{
		$reset_id=$_GET['reset_id'];	
		$qry=mysqli_query($dbcon,"update orderdetails set order_status='Ordered_Finished'  WHERE user_id ='$reset_id' and order_status='Ordered'");
		header("Location: customers.php");
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domino's pizza</title>
	 <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/datatables.min.js"></script>

    <meta name="description" content="A javascript plugin for intelligently selecting date and time ranges inspired by Google Calendar." />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.css" />

    <script src="lib/pikaday.js"></script>
    <link rel="stylesheet" type="text/css" href="lib/pikaday.css" />

    <script src="lib/jquery.ptTimeSelect.js"></script>
    <link rel="stylesheet" type="text/css" href="lib/jquery.ptTimeSelect.css" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-lightness/jquery-ui.css" type="text/css" media="all" />

    <script src="lib/moment.min.js"></script>
    <script src="lib/site.js"></script>
    <link rel="stylesheet" type="text/css" href="lib/site.css" />

    <script src="dist/datepair.js"></script>
    <script src="dist/jquery.datepair.js"></script>
	
    
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
                <a class="navbar-brand" href="index.php">Domino's Pizza - Administrator Panel</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li><a href="index.php"> &nbsp; &nbsp; &nbsp; Home</a></li>
					<li><a data-toggle="modal" data-target="#uploadModal"> &nbsp; &nbsp; &nbsp; Upload Items</a></li>
					<li><a href="items.php"> &nbsp; &nbsp; &nbsp; Item Management</a></li>
					<li class="active"><a href="customers.php"> &nbsp; &nbsp; &nbsp; Customer Management</a></li>
					<li><a href="orderdetails.php"> &nbsp; &nbsp; &nbsp; Order Details</a></li>
					<li><a href="reports.php"> &nbsp; &nbsp; &nbsp; Report details</a></li>
					<li><a href="logout.php"> &nbsp; &nbsp; &nbsp; Logout</a></li>
					
                    
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <a href="#"><i class="fa fa-calendar"></i>  <?php
                            $new=date('l, F d, Y');
                            echo $new; ?></a>
                        
                    </li>
                     <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php   extract($_SESSION); echo $admin_username; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            
                            <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
<br><br><br>
        <div id="page-wrapper">
            <div class="alert alert-danger">
                 <center> <h3><strong>Customer Management</strong> </h3></center>
				 </div>					                             
						                             
<form action="data.php" method="POST">
    <section id="examples">
        <article>
            <div class="demo">
                
                <p id="basicExample">
                    <input type="text" name="sdate" class="date start" /> to
                    
               
                    <input type="text" name="edate" class="date end" />
					
					&nbsp;&nbsp;&nbsp;<input type="submit" name="check" value="check">
                </p>
            </div>
</section>
            <script>
             
                $('#basicExample .date').datepicker({
                    'format': 'yyyy-m-d',
                    'autoclose': true
                });

                var basicExampleEl = document.getElementById('basicExample');
                var datepair = new Datepair(basicExampleEl);
            </script>
        </article>
		
        
</form>
        				  <br />
						  <br>
						  <div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Customer Email</th>
                  <th>Name</th>
				  <th>Address</th>
                  <th>Actions</th>
                 
                </tr>
              </thead>
              <tbody>
			  <?php

			  $dbcon=mysqli_connect("localhost","root","");
			  mysqli_select_db($dbcon,"pizzademo");

		$query=mysqli_query($dbcon,"SELECT * FROM users");
	
	if(mysqli_num_rows($query)> 0)
	{
		while($query2=mysqli_fetch_array($query))
		{
			extract($query2);
			?>
                <tr>
                  
                 <td><?php echo $user_email; ?></td>
				 <td><?php echo $user_firstname; ?> <?php echo $user_lastname; ?></td>
				 <td><?php echo $user_address; ?></td>
				 
				 <td>
				<a class="btn btn-success" href="view_orders.php?view_id=<?php echo $query2['user_id']; ?>" title="click for View Order" ><span class='glyphicon glyphicon-shopping-cart'></span> View Orders</a> 
				  <a class="btn btn-warning" href="?reset_id=<?php echo $query2['user_id']; ?>" title="click for Finish Order" onclick="return confirm('Are you sure to reset the customer items ordered?')">
				  <span class='glyphicon glyphicon-ban-circle'></span>
				  Finish Order</a>
				 <a class="btn btn-primary" href="previous_orders.php?previous_id=<?php echo $query2['user_id']; ?>" title="click for Previous Order" ><span class='glyphicon glyphicon-eye-open'></span> Previous Items Ordered</a> 
				
				
                  <a class="btn btn-danger" href="?delete_id=<?php echo $query2['user_id']; ?>" title="click for delete Account" onclick="return confirm('Are you sure to remove this customer?')">
				  <span class='glyphicon glyphicon-trash'></span>
				  Remove Account</a>
				
                  </td>
                </tr>
               
              <?php
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		echo "<br />";
		echo '<div class="alert alert-default" style="background-color:#033c73;">
                       <p style="color:white;text-align:center;">
                       &copy 2016 Dominos Pizza | All Rights Reserved |  Design by : Nikita Jadhav & Gauri Kumbhar

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
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Data Found ...
            </div>
        </div>
        <?php
	}
	
?>
		
	</div>
	</div>
	
	<br />
	<br />
           

           
        </div>
		
		
		
    </div>
    <!-- /#wrapper -->

	
	<!-- Mediul Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-md">
            <div style="color:white;background-color:#008CBA" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 style="color:white" class="modal-title" id="myModalLabel">Upload Items</h2>
              </div>
              <div class="modal-body">
         
				
			
				
				 <form enctype="multipart/form-data" method="post" action="additems.php">
                   <fieldset>
					
						
                            <p>Name of Item:</p>
                            <div class="form-group">
							
                                <input class="form-control" placeholder="Name of Item" name="item_name" type="text" required>
                           
							 
							</div>
							
							
							
							
							
							
							
							
							<p>Price:</p>
                            <div class="form-group">
							
                                <input id="priceinput" class="form-control" placeholder="Price" name="item_price" type="text" required>
                           
							 
							</div>
							
							
							<p>Choose Image:</p>
							<div class="form-group">
						
							 
                                <input class="form-control"  type="file" name="item_image" accept="image/*" required/>
                           
							</div>
				   
				   
					 </fieldset>
                  
            
              </div>
              <div class="modal-footer">
               
                <button class="btn btn-success btn-md" name="item_save">Save</button>
				
				 <button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
				
				
				   </form>
              </div>
            </div>
          </div>
        </div>
		
</body>
</html>
