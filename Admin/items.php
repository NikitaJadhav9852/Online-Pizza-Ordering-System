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
		
		$sql="DELETE FROM items WHERE item_id=$delete_id";
		$res1=mysqli_query($dbcon,$sql);// or die("failed".mysqli_error());		
		//$ress=mysqli_fetch_assoc($res1);

		if($res1){
			unlink('item_images/'.$_GET['pic']);
		}
		header("Location: items.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domino's pizza</title>
	 <link rel="shortcut icon" href="../assets/img/logoz.gif" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

   
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/datatables.min.js"></script>    
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
                <a class="navbar-brand" href="index.php">Domino's pizza - Administrator Panel</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li><a href="index.php"> &nbsp; &nbsp; &nbsp; Home</a></li>
					<li><a data-toggle="modal" data-target="#uploadModal"> &nbsp; &nbsp; &nbsp; Upload Items</a></li>
					<li class="active"><a href="items.php"> &nbsp; &nbsp; &nbsp; Item Management</a></li>
					<li><a href="customers.php"> &nbsp; &nbsp; &nbsp; Customer Management</a></li>
					<li><a href="orderdetails.php"> &nbsp; &nbsp; &nbsp; Order Details</a></li>
					<li><a href="reports.php"> &nbsp; &nbsp; &nbsp; Report details</a></li>
					<li><a href="logout.php"> &nbsp; &nbsp; &nbsp; Logout</a></li>
				     
                </ul>
                    <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                    <a href="#"><i class="fa fa-calendar"></i>
						<?php
                            $new=date('l, F d, Y');//(lowercase 'L')	Day of the Week F->Full Textual Representation of a Month d-> 	Day of the Month, 2 Digits, Leading Zeros Y->Numeric Representation of a Year, 4 Digits
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

        <div id="page-wrapper">
			 <div class="alert alert-danger">                        
                          <center> <h3><strong>Item Management</strong> </h3></center>
						  </div>
						  
						  <br />
						  
						  <div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Name of Item</th>
				  <th>Price</th>
				  <th>Date Added</th>
                  <th>Actions</th>
                 
                </tr>
              </thead>
              <tbody>
			  <?php
			  
				$dbcon=mysqli_connect("localhost","root","");
				mysqli_select_db($dbcon,"pizzademo");
				
				$query=mysqli_query($dbcon,"select * from items");

				if(mysqli_num_rows($query) > 0)
				{
					while($query2=mysqli_fetch_array($query))
					{
						extract($query2);
			?>
               <tr>
                  <td>
				<center> <img src="item_images/<?php echo $item_image; ?>" class="img img-rounded"  width="50" height="50" /></center>
				 </td>
                 <td><?php echo $item_name; ?></td>
				 <td>$ <?php echo $item_price; ?></td>
				 <td><?php echo $item_date; ?></td>
				 <td>
				
				 <a class="btn btn-info" href="edititem.php?edit_id=<?php echo $query2['item_id'];?>" title="click for edit" onclick="return confirm('Are you sure edit this item?')"><span class='glyphicon glyphicon-pencil'></span> Edit Item</a> 
				
                  <a class="btn btn-danger" href="?delete_id=<?php echo $query2['item_id'];?> &pic=<?php echo $query2['item_image'];?> " title="click for delete" onclick="return confirm('Are you sure to remove this item?')"><span class='glyphicon glyphicon-trash'></span> Remove Item</a>
				
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
                       &copy 2016 Dominos Pizza| All Rights Reserved |  Design by :Nikita Jadhav & Gauri Kumbhar

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
                           </div><p>Price:</p>
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