<?php
require_once('config.php');
?>

<?php
require_once('session2.php');
?>

<?php
if(isset($_GET['id']))
{$cand_id=$_GET['id'];
$_SESSION['candidate_id']=$cand_id;}
$cand_id=$_SESSION['candidate_id'];
	$user_query = mysqli_query($con,"select * from candidate where cand_id=$cand_id")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$candname = $row['cand_full_name'];
													$candcontactno = $row['cand_contactno'];
													//$candlname = $row['cand_last_name'];
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
													}
	if (isset($_POST['update'])){
		if (($_POST['cand_full_name'] == '')or($_POST['cand_father_name'] == '' )  or ($_POST['cand_dob'] == '')  or ($_POST['cand_nic'] == '') or ($_POST['password'] == '')or  ($_POST['cand_permenant_address'] == '') or ($_POST['cand_current_address'] == '') or ($_POST['cand_email'] == '') )
			{
			?> <script>
alert('Error Occured while updating');
window.location = "updatepro.php";
</script>
			<?php
			exit();
			}
	else{ 
		$firstname = addslashes("$_POST[cand_full_name]");
	    $fathername = addslashes("$_POST[cand_father_name]");
		$dob = addslashes("$_POST[cand_dob]");
		$nic = addslashes("$_POST[cand_nic]");
		$passw = md5(addslashes("$_POST[password]"));
		$candpermaddress = addslashes("$_POST[cand_permenant_address]");
		$candcuraddress = addslashes("$_POST[cand_current_address]");
		$email= addslashes("$_POST[cand_email]");
		$candcontact = addslashes("$_POST[cand_contactno]");
		if($password == $passw) {
		$checking=mysqli_query($con,"UPDATE candidate SET cand_full_name ='$firstname',cand_father_name ='$fathername', cand_dob ='$dob', cand_nic = '$nic',cand_email ='$email',cand_permenant_address='$candpermaddress',cand_current_address='$candcuraddress', modified_by= '$cand_id',modified_at = NOW(),cand_contactno = '$candcontact' WHERE cand_id = '$cand_id'")or die(mysqli_error($con)); 
		if($checking) { mysqli_commit($con);
		mysqli_close($con);
?>
<script>
alert('Updated Successfully');
window.location = "updateprofile.php";
</script>
<?php
}
else { mysqli_rollback($con);
		mysqli_close($con);
		?><script>
alert('Error While Updating');
window.location = "updatepro.php";
</script>
<?php
		}
}
else {
?>
<script>
alert('Password doesnot match with eachother');
window.location = "updatepro.php";
</script>
<?php }}}?>

<?php include('headeradmin.php'); ?>

 <nav>
  <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" role="form" method="post">
			<h3><center>Edit Information</center></h3>
			<br>									
			<div> 
					<div class="form-group">
							  <label class="col-md-5 control-label" for="rental">First Name:</label>
							  <div class="col-md-3">
					<input type="text" name="cand_full_name" id = "fname" class="form-control input-md" placeholder="please enter first name" pattern="[A-Za-z. ]{1,50}" value= "<?php echo $candname; ?>" required/> 
						</div>
						</div>
						
                    <div class="form-group">

							  <label class="col-md-5 control-label">Father Name:</label>
							  <div class="col-md-3">
					<input type="text" name="cand_father_name" id = "fname" class="form-control input-md" placeholder="please enter first name" pattern="[A-Za-z. ]{1,50}" value= "<?php echo $candfname; ?>" required/> 
					</div>
					</div>
                      
                <div class="form-group">
							  <label class="col-md-5 control-label">Email:</label>
							  <div class="col-md-3">
						<input type="text" name="cand_email" id = "email" class="form-control input-md"  placeholder="Email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" title="Incorrect Email" value="<?php echo $candemail; ?>"required/>
					</div>
				</div>
                 <div class="form-group">
							  <label class="col-md-5 control-label">NIC: [14Digit Number]</label>
							  <div class="col-md-3">
						<input type="text" name="cand_nic" id = "nic" class="form-control input-md"  placeholder="NIC" pattern="[0-9]{14}" title="Numbers Only" value="<?php echo $candnic; ?>" required/>
					</div>
				</div>	
				<div class="form-group">
							  <label class="col-md-5 control-label" for="rental">Date of birth:</label>
							  <div class="col-md-3">
						<input type="date" name="cand_dob" id = "bdate" title="click to choose a date" class="form-control input-md" placeholder="1900-1-31" value = <?php echo $canddob; ?> required/>
					</div>
				</div>
                <div class="form-group">
							  <label class="col-md-5 control-label">Place of birth:</label>
							  <div class="col-md-3">
					<input type="date" name="cand_pob" id = "bdate" title="click to choose a date" class="form-control input-md" placeholder="1900-1-31" value = <?php echo $candpob; ?> required/>
					</div>
					</div>
				<div class="form-group">
							  <label class="col-md-5 control-label" for="rental">Permenant Address:</label>
							  <div class="col-md-3">
						<input type="text" name="cand_permenant_address" id = "address" class="form-control input-md" placeholder="Permenant Address" pattern="[A-Za-z0-9.#/\-_,' ]{6,50}" value= "<?php echo $candpermaddress; ?>" required/>
					</div>
				</div>
                <div class="form-group">
							  <label class="col-md-5 control-label" for="rental">Current Address:</label>
							  <div class="col-md-3">
						<input type="text" name="cand_current_address" id = "address" class="form-control input-md" placeholder="Current Address" pattern="[A-Za-z0-9.#/\-_,' ]{6,50}"  value="<?php echo $candcuraddress; ?>" required/>
					</div>
				</div>
		
        		<div class="form-group">
                							  <label class="col-md-5 control-label" for="rental">Contact No.:</label>
							  <div class="col-md-3">
					 <input type="text" name="cand_contactno" id = "contact" class="form-control input-md" title="input number only" placeholder="Contact Number"  pattern="[0-9]{11}" title="Numbers Only" value = "<?php echo $candcontactno; ?>" required/>
					</div>
				</div>
  
 <div class="form-group">
							  <label class="col-md-5 control-label" for="rental">Password:</label>
							  <div class="col-md-3">
						<input type="password" name="password" id = "password" class="form-control input-md" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20}" title="Should be atleast six characters with atleast 1 special character"  required/>
					</div>
				</div>
               <div class="control-group">
				<div class="controls" align="center">
						           				 <button name="update" class="btn btn-success">Update</button>
												 <a button id="cancel" name="cancel" class="btn btn-danger" href="admin.php" >Cancel</button></a>
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