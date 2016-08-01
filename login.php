<?php
require_once('config.php');
?>
<?php
$r =1; 
$s=1;

//Start session
session_start();
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
		//Sanitize the POST values
    $email = clean($_POST['email']);
    $password = clean(md5($_POST['password']));
//Create query
$qry="SELECT * from `candidate` WHERE (cand_email = '$email' or Ref_id='$email' ) and cand_password = '$password' and isapprove = 1 and isactive =1";
	$result=mysqli_query($con,$qry);
	$qry1="SELECT * from `administration` WHERE admin_email = '$email' and admin_password = '$password'";
	$row=mysqli_query($con,$qry1);
if($result) { 
			if(mysqli_num_rows($result) > 0 ) {
			//Login Successful
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			$_SESSION['Ref_id'] = $member['Ref_id'];
			$_SESSION['cand_id'] = $member['cand_id'];
			$id = $member['cand_id'];
			$_SESSION['fname']=$member['cand_full_name'];
			$_SESSION['password'] = $member['cand_password'];
			$_SESSION['email'] = $member['cand_email'];
			$_SESSION['image'] = $member['cand_profile_pic'];
			$select = "SELECT HOST FROM information_schema.processlist where id = connection_id()";
$qry=mysqli_query($con,$select);
		while($rec = mysqli_fetch_array($qry)){
		$host = "$rec[HOST]";}
			mysqli_query($con,"INSERT INTO `Login` (`login_id`,`cand_id`, `login_time`, `logout_time`, `ip_address`) VALUES ('','$id', NOW(), '', '$host')")or die(mysqli_error($con));
			$qry="SELECT max(login_id) as log_id from `login` WHERE cand_id = '$id' ";
	$qry=mysqli_query($con,$qry);
while($rec = mysqli_fetch_array($qry)){
		$_SESSION['log_id'] = $rec['log_id'];}
		mysqli_commit($con);
		mysqli_close($con);
			session_write_close();
			header("location: loc.php?");
			exit();
			}
			else {$r =0;}
		}
		if($row)
			{ 
			if(mysqli_num_rows($row) > 0 ) {
			session_regenerate_id();
			while($rec = mysqli_fetch_assoc($row)){
			$_SESSION['id'] = $rec['admin_id'];
			$_SESSION['email'] = $rec['admin_email'];
			$_SESSION['password'] = $member['admin_password'];
		$position = $rec['admin_position']; 
		}
		if($position == "finance")
			{header("location: finance.php?");
			exit(); }
	    else if($position == "admin")
			{header("location: admin.php?"); 
			exit();
			}
			}
			else { $s=0;  }
			}
		if($s==0 && $r==0) {
		
		$user_query = mysqli_query($con,"select isactive from candidate where (cand_email = '$email' or Ref_id='$email' )")or die(mysql_ereror());
													while($row = mysqli_fetch_array($user_query)){
													$isactive = $row['isactive'];
													}
													if(mysqli_num_rows($user_query)>0){
											if($isactive ==0) {header("location: login_errors.php"); exit(); }
												else {header("location: login_error.php"); exit();} }
												else {header("location: login_error.php"); exit();} 
		} 
	
?>
