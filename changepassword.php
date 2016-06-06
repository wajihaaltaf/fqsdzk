<?php
mysql_select_db('pia',mysql_connect('localhost','root',''))or die(mysql_error());
?>

<?php
require_once('session1.php');
?>

<?php
$cand_id=$_SESSION['cand_id'];
$cand_email = $_SESSION['email'];
$user_query = mysql_query("select cand_password from candidate where cand_id=$cand_id")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													$candpassword = $row['cand_password']; }
	if (isset($_POST['update'])){
		if (($_POST['cpassword'] == '')or($_POST['npassword'] == '')or($_POST['rnpassword'] == '' ) )
			{
			echo "You Must Fill All";
			}
	else{ 
		$cpassword = md5(addslashes("$_POST[cpassword]"));
		$npassword = md5(addslashes("$_POST[npassword]"));
		$rnpassword = md5(addslashes("$_POST[rnpassword]"));
		?>
	
   <?php if($candpassword == $cpassword)
   { if($npassword == $rnpassword){
		mysql_query("UPDATE candidate SET cand_password ='$npassword' WHERE cand_id = '$cand_id' and cand_email = '$cand_email' ")or die(mysql_error()); 	
?>
<script>
alert('Updated Successfully');
window.location = "loc.php";
</script>
<?php
}
else {
?>
<script>
alert('Password doesnot match with Each Other');
window.location = "changepassword.php";
</script>
<?php
}}
else { 
?>
<script>
alert('Password doesnot match Current Password');
window.location = "changepassword.php";
</script>
<?php 
}}}
include('headercand.php');?>
  <nav>
   <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" role="form" method="post" autocomplete="off">
			<h3><center>Change Password</center></h3>
			<br>									
			<div>  
					<div class="form-group">
							  <label class="col-md-5 control-label" for="rental">Current:</label>
							  <div class="col-md-3">
					<input type="Password" name="cpassword" id = "fname" class="form-control input-md" required/> 
						</div>
						</div>
                        <div class="form-group">
							  <label class="col-md-5 control-label" for="rental">New:</label>
							  <div class="col-md-3">
						<input type="password" name="npassword" id = "password" class="form-control input-md" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20}" title="Should be atleast six characters with atleast 1 special character"  required/>
					</div>
				</div>
                <div class="form-group">
							  <label class="col-md-5 control-label" for="rental">Re-type New:</label>
							  <div class="col-md-3">
						<input type="password" name="rnpassword" id = "password" class="form-control input-md" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20}" title="Should be atleast six characters with atleast 1 special character"  required/>
					</div>
				</div>
                       <div class="control-group">
				<div class="controls" align="center">
                 <button name="update" class="btn btn-success">Save Changes</button>
												 <a button id="cancel" name="cancel" class="btn btn-danger" href="loc.php" >Cancel</button></a>
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
                                    
  </nav>

  </div>
  </div>
    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
	<?php include('script.php'); ?>
</body>
</html>