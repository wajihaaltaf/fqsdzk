<?php
mysql_select_db('pia',mysql_connect('localhost','root',''))or die(mysql_error());
?>

<?php
require_once('session1.php');
include('headercand.php');
?>
			<nav>
				
                <center><h2>Courses<h2></center>
				<div class="col-sm-12">
				<div class="span7" id="">  
                     <div class="row-fluid">
					  <?php	
	                   $count_client=mysql_query("select * from module");
	                   $count = mysql_num_rows($count_client);
                       ?>	
                        <!-- block -->						
                        <div id="block_bg" class="block">	
                            <div class="navbar navbar-inner block-header">
							<br>
                                <div class="muted pull-right">&nbsp;&nbsp;&nbsp; Enroll</div><div class="muted pull-right"><span class="label label-warning"><?php echo $count;?></span></div>
														
                            <div class="block-content collapse in">
                                <div class="span12">
								
								<!-----------------------form --------------------->
								
  								<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
									
										<thead>
										  <tr>
												<th></th>
												<th>Course Name</th>
												<th>Module Name</th>
												<th>Enroll</th>
												<script src="js/jquery.dataTables.min.js"></script>
                                                <script src="js/DT_bootstrap.js"></script>
												<th></th>
										   </tr>
										</thead>
										<tbody>
													<?php
													$user_query = mysql_query("select * from module where course_title='B1' ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													$id = $row['module_id'];
													$mname= $row['module_name'];
											?>
									
												<tr>
												<td width="30">
												</td>
												<td><?php 
												echo "B1"; ?></td>
	
												<td><?php echo $row['module_name']; ?></td>
											
												<td class="col-md-1">
												<a href="enrollmentform.php <?php echo '?id='.$id; ?>" class="btn btn-success"><i class="glyphicon glyphicon-pencil"></i></a>
											
							</tr>
												<?php }?>
                                                	<?php
													$user_query = mysql_query("select * from module where course_title='B2' ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													$id = $row['module_id'];
													$mname= $row['module_name'];
											?>
									
												<tr>
												<td width="30">
												</td>
												<td><?php 
												echo "B2"; ?></td>
	
												<td><?php echo $row['module_name']; ?></td>
											
												<td class="col-md-1">
												<a href="enrollmentform.php <?php echo '?id='.$id; ?>" class="btn btn-success"><i class="glyphicon glyphicon-pencil"></i></a>
											
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