<?php
require_once('config.php');
?>

<?php
require_once('session2.php');
?>

<?php include('headeradmin.php'); ?>
            <!-- Page Heading -->
<div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
		

                <!-- Page Heading -->
			<nav>
				
                <center><h2>UPDATE PROFILE<h2></center>
				<div class="col-sm-12">
				<div class="span7" id="">  
                     <div class="row-fluid">
					  <?php	
	                   $count_client=mysqli_query($con,"select * from candidate where isapprove =1 and isactive =1");
	                   $count = mysqli_num_rows($count_client);
                       ?>	
                        <!-- block -->						
                        <div id="block_bg" class="block">	
                            <div class="navbar navbar-inner block-header">
							<br>
                                <div class="muted pull-right">&nbsp;&nbsp;&nbsp; Employee log</div><div class="muted pull-right"><span class="label label-warning"><?php echo $count;?></span></div>
														
                            <div class="block-content collapse in">
                                <div class="span12">
								
								<!-----------------------form --------------------->
								
  								<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
									
										<thead>
										  <tr>
												<th></th>
												<th>Candidate Name</th>
												<th>Candidate Email</th>
												<th>Update</th>
												<script src="js/jquery.dataTables.min.js"></script>
                                                <script src="js/DT_bootstrap.js"></script>
												<th></th>
										   </tr>
										</thead>
										<tbody>
													<?php
													$user_query = mysqli_query($con,"select * from candidate where isapprove=1 and isactive=1")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$id = $row['cand_id'];
													$cname= $row['cand_full_name'];
													
											?>
									
												<tr>
												<td width="30">
												</td>
												<td><?php echo $cname; ?></td>
	
												<td><?php echo $row['cand_email']; ?></td>
											
												<td class="col-md-1">

												<a href="updatepro.php<?php echo '?id='.$id; ?>" class="btn btn-success"><i class="glyphicon glyphicon-pencil"></i></a>
											
							</tr>
												<?php }?>
                                               
										</tbody>
									</table>
								</form>

						 </div>
                            </div>
                        </div>
	
</div>
            <!-- /.container-fluid -->

        </div>
                                </div>
                            </div>
                        </div>
	
</div>
            <!-- /.container-fluid -->

        </div>
     
        <!-- /#page-wrapper -->

    </div>
    </div>
    </div>
    </div>
    </div>
	</nav>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
	</body>
</html>