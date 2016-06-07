<?php
require_once('config.php');

require_once('session2.php');
?>

<?php
$cand_id=$_GET['id'];
	$user_query = mysqli_query($con,"select * from candidate where cand_id=$cand_id")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$candname = $row['cand_full_name'];
													$candcontactno = $row['cand_contactno'];
													$candlname = $row['cand_last_name'];
												    $candfname = $row['cand_father_name'];
													$gender = $row['cand_gender'];
											        $candnic = $row['cand_nic'];
													$canddob = $row['cand_dob'];
													$candpob = $row['cand_pob'];
												    $candemail = $row['cand_email'];
													$candpermaddress = $row['cand_permenant_address'];
													$candcuraddress = $row['cand_current_address'];
													$password = $row['cand_password'];
													$image = $row['cand_profile_pic'];
													$ref_id = $row['Ref_id'];
													$activation = $row['Activation'];
													}
	if (isset($_POST['approve'])){
		
}
 ?>
<?php include('headeradmin.php'); ?>
 <nav>
  <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" role="form" method="post">
			<h3><center>Candidate Information</center></h3>
			<br>		
            	<table>
	<tr>
		<td width="40%" height="100%">
 <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" width="300px" height="500px"class="img-rounded" align="top"/>
		</td>
        <td width="10%">
        </td>
		<td width="50%">						
 <div class="form-group">
							  <label class="col-md-5 control-label" for="rental">Ref_id:</label>
                               <?php echo $ref_id; 
							   $user_query = mysqli_query($con,"select Ref_id from candidate where Ref_id = '$ref_id' ")or die(mysqli_error($con));
													if(mysqli_num_rows($user_query)> 1)
													echo "(Ref id already exist)"; ?>
			</div>
					
					<div class="form-group">
							  <label class="col-md-5 control-label" for="rental">First Name:</label>
                               <?php echo $candname; ?>
			</div>
					
						
                    <div class="form-group">
							  <label class="col-md-5 control-label">Father Name:</label>
							 <?php echo $candfname; ?>
                 </div>
					<div class="form-group">
							  <label class="col-md-5 control-label">Gender:</label>
							  <?php echo $gender; ?>
                              </div>
                <div class="form-group">
							  <label class="col-md-5 control-label">Email:</label>
							  <?php echo $candemail; ?>
				
				</div>
                 <div class="form-group">
							  <label class="col-md-5 control-label">NIC: </label>
							<?php echo $candnic; ?>
					</div>
				
				<div class="form-group">
							  <label class="col-md-5 control-label" for="rental">Date of birth:</label>
							 <?php echo $canddob; ?> 
					
				</div>
                <div class="form-group">
							  <label class="col-md-5 control-label">Place of birth:</label>
							<?php echo $candpob; ?> 
					</div>
					
				<div class="form-group">
							  <label class="col-md-5 control-label" for="rental">Permenant Address:</label>
							  <?php echo $candpermaddress; ?>
					</div>
				
                <div class="form-group">
							  <label class="col-md-5 control-label" for="rental">Current Address:</label>
							  <?php echo $candcuraddress; ?>
					</div>
				
				<div class="form-group">
                							  <label class="col-md-5 control-label" for="rental">Contact No.:</label>
							 <?php echo $candcontactno; ?>
					</div>
     
    </td></tr></table>

               <div class="control-group">
				<div class="controls" align="center">
						           				<a button id="cancel" name="cancel" class="btn btn-danger" href="candidatelog.php" >Back</button></a>
						           			 </div></div>
											 <br>
											 <br>
											 <br>
											 <br>
                                   
									</tr>
									</tbody>
						            </div>
									</center>
                                 </form>      
                                    
                            </div>                          
                        </div>                     
                    </div>                   
                </div>
			</div>
           </div>
		</div>	</div>
        
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