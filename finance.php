<?php
require_once('config.php');
?>
<?php
require_once('session2.php');
?>
<?php include('header.php'); ?>

<body>
	 <div id="page-wrapper">
            <div class="container-fluid">	
  <nav>
   <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">DASHBOARD</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                
                        </div>
                    </div>
                </div>
                           <div class="row">
            <div class=" col-md-12 col-sm-12">
               
              
             
              <div class=" col-md-12 col-sm-12">
                  <div class="list-group">
                            <a href="#" class="list-group-item active">
                                <h4 class="list-group-item-heading">You are logged in as: </h4>
                                <p class="list-group-item-text" style="line-height: 30px;">
                              <b> Email: <?php echo $_SESSION['email']; ?>
                               <br>
                             Total Voucher Inserted: <?php $zero=0;
							
							  $user_query = mysqli_query($con,"SELECT voucher_id FROM voucher WHERE admin_id=1 ")or die(mysqli_error($con));
													$balance = mysqli_num_rows($user_query);
													if($balance=="" || $balance==0)
													echo $zero;
													else echo $balance; ?></b>
                                                    
                              
                                </p>
                            </a>
                        </div>
                  <br />
                  <div class=" col-md-12 col-sm-8">
              <div id="calendar"></div>
        </div>
                               </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
        </div>
    <!-- /. WRAPPER  -->

  </nav>
  
  </div>
  </div>
  </div>
</body>
</html>
