<?php
require_once('config.php');
require_once('session1.php');
include('headercand.php');
?>
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
                 <h3> <b>REMAINING BALANCE: <?php $zero=0;
							  $cand_id= $_SESSION['cand_id'];
							  $user_query = mysqli_query($con,"SELECT balance FROM user_transaction WHERE user_transaction.cand_id='$cand_id' and transaction_time=(SELECT MAX(transaction_time) from user_transaction)")or die(mysqli_error($con));
													$row = mysqli_fetch_array($user_query);
													$balance=$row['balance'];
													if($balance=="")
													echo $zero;
													else echo $balance; ?></b></h3>
                        </div>
                    </div>
                </div>
                           <div class="row">
            <div class=" col-md-4 col-sm-4">
                <div class="table-responsive">
                  
                        </div>
                <div class="alert  alert-info">
                    <div class="current-notices">

                            <h3>NEW SCHEDULES:</h3>
                    <hr />
                    <ul>
                        <?php 
						$query=mysqli_query($con,"select module.module_name,category.category_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date FROM schedule,module,category where module.module_id=schedule.module_id and category.category_id=module.category_id and exam_date > NOW() ORDER BY `exam_date` DESC LIMIT 3 ")or die(mysqli_error($con));
		while($row=mysqli_fetch_array($query)) {
						?>
                        <li>
                        <?php echo $row['category_name']."-".$row['module_name']." ".$row['exam_date']; }?> 
                        </li>
                    </ul>
                        </div>
                        </div>
  
                        </div>
              
             
              <div class=" col-md-8 col-sm-8">
                  <div class="list-group">
                            <a href="#" class="list-group-item active">
                                <h4 class="list-group-item-heading">You are logged in as: </h4>
                                <p class="list-group-item-text" style="line-height: 30px;">
                               Name: <?php echo $_SESSION['fname']; ?>
                               <br>
                              Email: <?php echo $_SESSION['email']; ?>
                              
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
