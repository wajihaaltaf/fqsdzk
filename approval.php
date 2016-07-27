<?php
require_once('config.php');

require_once 'PHPMailer/PHPMailerAutoload.php';

//define('GUSER', 'bisma@ayazahmed.com'); // GMail username
//define('GPWD', 'Bisma2015'); // GMail password
//DEFINE('WEBSITE_URL', 'http://localhost');


function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'srv10.hosterpk.com'; //smtp.gmail.com';
	$mail->Port = 465; //465; 
	$mail->Username = GUSER;  
	$mail->Password = GPWD;           
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send())
	{
		$error = 'Mail error: '.$mail->ErrorInfo; 
		echo $error;
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}

?>


<?php
require_once('session2.php');
?>

<?php
$cand_id=$_GET['id'];
$admin_email = $_SESSION['email'];
	$user_query = mysqli_query($con,"select * from candidate where cand_id=$cand_id")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$candname = $row['cand_full_name'];
													$candcontactno = $row['cand_contactno'];
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
		$qry=mysqli_query($con,"UPDATE `candidate` SET isapprove=1,isapproveby='$admin_email' WHERE `candidate`.`cand_id` = '$cand_id' ")or die(mysqli_error($con));
		if($qry)
		{ mysqli_commit($con);
		mysqli_close($con);
		$message = "Your Account is approved To activate your account, please click on this link:\n\n";
                $message .= WEBSITE_URL . '/PIA/activates.php?email=' . urlencode($candemail) . "&key=$activation";

if (smtpmailer($candemail, 'ptc.exam@gmail.com', 'PIA| Signin', 'Registration Confirmation', $message)) {
	// Finish the page:
                $msg='<div class="success">Thank you for
registering! A confirmation email
has been sent to '.$candemail.' Please click on the Activation Link to Activate your account </div>';

	
}
?>
<script>
alert('Approved Successfully');
window.location = "approverequest.php";
</script>

<?php }
else {// If it did not run OK.
mysqli_rollback($con);
		mysqli_close($con);
                  $msg='<div class="errormsgbox">You could not be registered due to a system
error. We apologize for any
inconvenience.</div>';
 ?>
<script>
alert('Error Occured');
window.location = "approverequest.php";
</script>

<?php
		}}
 ?>
<?php include('headeradmin.php'); ?>
 <nav>
  <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" role="form" method="post">
			<h3><center>Approve</center></h3>
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
							  <label class="col-md-5 control-label" for="rental">Name:</label>
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
						           				 <button name="approve" class="btn btn-success">Approve</button>
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