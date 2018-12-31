<?php
session_start();
if(!$_SESSION['admin_username'])
{
    header("Location: ../index.php");
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
                <a class="navbar-brand" href="index.php">Domino's pizza - Administrator Panel</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active"><a href="index.php"> &nbsp; &nbsp; &nbsp; Home</a></li>
					<li><a data-toggle="modal" data-target="#uploadModal"> &nbsp; &nbsp; &nbsp; Upload Items</a></li>
					<li><a href="items.php"> &nbsp; &nbsp; &nbsp; Item Management</a></li>
					<li><a href="customers.php"> &nbsp; &nbsp; &nbsp; Customer Management</a></li>
					<li><a href="orderdetails.php"> &nbsp; &nbsp; &nbsp; Order Details</a></li>
					<li><a href="reports.php"> &nbsp; &nbsp; &nbsp; Reports Details</a></li>
					<li><a href="logout.php"> &nbsp; &nbsp; &nbsp; Logout</a></li>
					
                    
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <a href="#"><i class="fa fa-calendar"></i>
						<?php
                            $new=date('l, F d, Y');
                            echo $new; ?></a>
                        
                    </li>
                     <li class="dropdown user-dropdown">
					    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php extract($_SESSION); echo $admin_username; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">                           
                            <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
  <!-- Indicators -->
  

    <!-- Wrapper for slides -->
 
<div class="slideshow-container">
 <img src="pizza1.jpg" id="myPhoto" alt="Hero Slide" style="width:100%;height:500px;">
</div>
<br>


<script>
var myImage=document.getElementById("myPhoto");
var imageArray=["pizza1.jpg","pizza2.jpg","pizza3.jpg","pizza4.jpg","pizza5.jpg","pizza6.jpg"];
var imageIndex=0;
function changeImage()
{
	myPhoto.setAttribute("src",imageArray[imageIndex]);
	imageIndex++;

	if(imageIndex>=imageArray.length)
	{
		imageIndex=0;
	}
	
}
var intervalHandler=setInterval(changeImage,1500);

</script>
<!-- #my-carousel-->
			
			</div>
			
			
		<br />	
			 <div class="alert alert-danger">
                        
                          &nbsp; &nbsp; Welcome to Domino's Pizza! So, if you're looking for an Delisious Pizza , why not visit the Domino's Pizza? 
						It's that easy. If you have a favorite Pizza, 
						this is the easiest and most straightforward way to get it.A lot of Pizza Items who are well known for one thing, 
						like pizza, also sell completes with 
						their own special toppings, along with other varities for things like cheese Pizza,Veg,and non-veg pizza etc.<br>
					<br />
			
			<div class="alert alert-default" style="background-color:#033c73;">
                       <p style="color:white;text-align:center;">
                       &copy 2016 Domino's pizza| All Rights Reserved |  Design by :Nikita jadhav& Gauri Kumbhar

						</p>
                        
                    </div>
            
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