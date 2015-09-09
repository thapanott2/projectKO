<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap/css/nava.css" rel="stylesheet">

<div class="container">
<div class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            
                        </button>
                        <a class="navbar-brand" href="#">Ko Ko ChianMai Touring</a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                          <li class="active"><a href="index.php"><strong>HOMEPAGE</strong></a></li>
                          <li class="active"><a href="check_cart.php"><strong>Cart-Check</strong></a></li>
						 <?php
	if(!isset($_SESSION['user_id'])) {
						?>
      
                            <li class="active"><a href="user_subscribe.php"><strong>User Register</strong></a></li>
                            <li class="active"><a href="user_login.php"><strong>LOGIN</strong></a></li>
                           
                            
							<?php
						}
					else {
								?>      			
       								<li class="active"><a href="user_logout.php"><strong>LOGOUT</strong></a></li>
									 <li class="active"><a href="#"><strong> User: <?php echo $_SESSION['user_name']; ?></strong></a></li> 
							 <?php
								 }
						 		?>
     
   				  </ul>
                    </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
            </div>
            </div>