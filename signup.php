<?php
require_once('config.php');
?>
<?php if (!isset($_POST['register'])){ $_POST['fname']= NULL; $_POST['fathername']= NULL; $_POST['dob']=NULL; $_POST['pob']=NULL; $_POST['organization']= NULL; $_POST['paddress']=NULL; $_POST['caddress']=NULL; 
$_POST['contact']=NULL; $_POST['image']=NULL; $_POST['nicimage']=NULL; $_POST['nic']=NULL;$_POST['email']=NULL;$_POST['refid']=NULL;} ?>
<?php
	if (isset($_POST['register'])){
	$firstname=mysql_real_escape_string($_POST['fname']);
	$refid=mysql_real_escape_string($_POST['refid']);
	$fathername=mysql_real_escape_string($_POST['fathername']);
	$email=mysql_real_escape_string($_POST['email']);
	$NIC=mysql_real_escape_string($_POST['nic']);
	$gender=mysql_real_escape_string($_POST['gender']);
	$bdate=mysql_real_escape_string($_POST['dob']);
	$bdate = date('d-m-Y', strtotime(str_replace('-','/',$bdate))); 
	$bdate = date('Y-m-d', strtotime($bdate));
	$pob=mysql_real_escape_string($_POST['pob']);
	$organization=mysql_real_escape_string($_POST['organization']);
	$paddress=mysql_real_escape_string($_POST['paddress']);
	$caddress=mysql_real_escape_string($_POST['caddress']);
	$contact=mysql_real_escape_string($_POST['contact']);
	$password = md5(mysql_real_escape_string($_POST['password']));

  $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    /*if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["imageUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
*/
    $image=basename( $_FILES["imageUpload"]["name"],".jpg");
    $image=addslashes(file_get_contents($target_file));

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["nicimage"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);  

   /* if (move_uploaded_file($_FILES["nicimage"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["nicimage"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }*/

    $nicimg=basename( $_FILES["nicimage"]["name"],".jpg");
	
	$f = mysqli_query($con,"SELECT cand_id from candidate where cand_email='$email' or cand_nic='$NIC' or cand_contactno='$contact' or Ref_id='$refid' ")or die(mysqli_error($con));
													$count = mysqli_num_rows($f);
													if($count <= 0)
													{
													if($firstname=="" || $fathername=="" || $email=="" || $nicimg=="" || $image=="" || $password=="" || $contact == "" || $caddress == "" || $paddress=="" || $organization == "" || $pob == "" || $bdate== "" || $gender == "" || $NIC=="") 
													{?><script>
alert('Some Error Occured While Signing UP!');
window.location = "signup.php";
</script> <?php exit(); }
													else {
	$checking=mysqli_query($con,"INSERT INTO `candidate` (`Ref_id`, `cand_id`, `cand_password`, `cand_full_name`, `cand_father_name`, `cand_nic`, `cand_dob`, `cand_gender`, `cand_contactno`, `cand_email`, `cand_permenant_address`, `cand_current_address`, `cand_nic_attachment`, `cand_profile_pic`,`cand_pob`,`cand_organization`,`isactive`) VALUES ('0', '', '$password', '$firstname', '$fathername', '$NIC', '$bdate', '$gender', '$contact', '$email', '$paddress', '$caddress','$nicimg','$image','$pob','$organization','0')")or die(mysqli_error($con));
	if($checking)
	{
 if($organization=="Pakistan International Airlines") {$org="PIA"; } else {$org="PVT"; }
 if($_POST['refid']=='')
{
$select = "SELECT max(cand_id) as cand_id FROM candidate";
$qry=mysqli_query($con,$select);
		while($rec = mysqli_fetch_array($qry)) {
		$cand_id = "$rec[cand_id]";}
		$cand_idd = "000" .$cand_id;
		$cand_idd = substr($cand_idd, -4);
		$year = date("Y");
		$ref_id= $year. $org. $cand_idd;
		mysqli_query($con,"UPDATE `candidate` SET `Ref_id` = '$ref_id',isapprove=0 WHERE `candidate`.`cand_id` = '$cand_id' ")or die(mysqli_error($con));
	    mysqli_commit($con);
		 mysqli_close($con);
		?>
<script>
alert('Your Account will be activated after admin approval.You will get confirmation email soon');
window.location = "index.php";
</script>
<?php }
else  {$qry=mysqli_query($con,"UPDATE `candidate` SET `Ref_id` = '$refid',isapprove=0 WHERE `candidate`.`cand_id` = '$cand_id' ")or die(mysqli_error($con));
mysqli_commit($con);
 mysqli_close($con);
		?>
<script>
alert('Your Account will be activated after admin approval.You will get confirmation email soon');
window.location = "index.php";
</script>
<?php
   }}
   else {
   mysqli_rollback($con);
   mysqli_close($con);
   ?>
<script>
alert('Your Account will be activated after admin approval.You will get confirmation email soon');
window.location = "index.php";
</script>
<?php }}}
else {
   $f = mysqli_query($con,"SELECT cand_id from candidate where  cand_nic='$NIC'  ")or die(mysqli_error($con));
													$count = mysqli_num_rows($f);
													$f = mysqli_query($con,"SELECT cand_email from candidate where  cand_email='$email'  ")or die(mysqli_error($con));
													$count1 = mysqli_num_rows($f);
													$f = mysqli_query($con,"SELECT cand_contactno from candidate where  cand_contactno='$contact'  ")or die(mysqli_error($con));
													$count2 = mysqli_num_rows($f);
													$f = mysqli_query($con,"SELECT cand_contactno from candidate where Ref_id='$refid'")or die(mysqli_error($con));
													$count3 = mysqli_num_rows($f);
 if( $count>0 AND $count1<=0 AND $count2<=0 and $count3<=0) {
 ?> <script> alert('NIC already exist!'); </script> <?php $_POST['nic']=NULL;
  echo '<div class="errormsgbox">NIC already exist!</div>';}
 else if($count<=0 AND $count1>0 AND $count2<=0 and $count3<=0) {
 ?> <script> alert('email already exist!'); </script> <?php  $_POST['email']=NULL;
  echo '<div class="errormsgbox">Email already exist!</div>';}
 else if ($count<=0 AND $count1<=0 AND $count2>0 and $count3<=0)
 {?> <script> alert('contact no already exist!'); </script> <?php $_POST['contact']=NULL;
 echo '<div class="errormsgbox">Contact no already exist!</div>';
 }
  else if ($count<=0 AND $count1<=0 AND $count2<=0 and $count3>0)
 {?> <script> alert('Refrence id already exist!'); </script> <?php  $_POST['refid']=NULL;
echo '<div class="errormsgbox">Refrence id already exist!</div>';
 }
 else if( $count>0 AND $count1>0 AND $count2<=0 and $count3<=0) {
 ?> <script> alert('NIC and email already exist!'); </script> <?php  $_POST['email']=NULL; $_POST['nic']=NULL;
 echo '<div class="errormsgbox"NIC and email already exist!</div>';}
 else if( $count>0 AND $count1<=0 AND $count2>0 and $count3<=0) {
 ?> <script> alert('NIC and contact number already exist!'); </script> <?php  $_POST['contact']=NULL; $_POST['nic']=NULL;
 echo '<div class="errormsgbox">NIC and contact number already exist!</div>';}
 else if( $count<=0 AND $count1>0 AND $count2>0 and $count3<=0) {
 ?> <script> alert('Email and contact number already exist!'); </script> <?php  $_POST['email']=NULL; $_POST['contact']=NULL;
 echo '<div class="errormsgbox">Email and contact number already exist!</div>';}
 else if( $count<=0 AND $count1<=0 AND $count2>0 and $count3>0) {
 ?> <script> alert('Refrence_id and contact number already exist!'); </script> <?php  $_POST['refid']=NULL; $_POST['contact']=NULL;
 echo '<div class="errormsgbox">Refrence_id and contact number already exist!</div>';}
 else if( $count<=0 AND $count1>0 AND $count2<=0 and $count3>0) {
 ?> <script> alert('Refrence_id and Email already exist!'); </script> <?php  $_POST['email']=NULL; $_POST['refid']=NULL;
 echo '<div class="errormsgbox">Refrence_id and Email already exist!</div>';}
 else if( $count>0 AND $count1<=0 AND $count2<=0 and $count3>0) {
 ?> <script> alert('Refrence_id and NIC already exist!'); </script> <?php $_POST['refid']=NULL; $_POST['nic']=NULL;
 echo '<div class="errormsgbox">Refrence_id and NIC already exist!</div>'; }
 else if( $count>0 AND $count1>0 AND $count2>0 and $count3<=0) {
 ?> <script> alert('NIC,Email and Contact already exist!'); </script> <?php  $_POST['contact']=NULL; $_POST['email']=NULL; $_POST['nic']=NULL;
 echo '<div class="errormsgbox">NIC,Email and Contact already exist!</div>';}
 else if( $count>0 AND $count1>0 AND $count2<=0 and $count3>0) {
 ?> <script> alert('NIC,Email and Refrence_id already exist!'); </script> <?php  $_POST['refid']=NULL; $_POST['email']=NULL; $_POST['nic']=NULL; 
 echo '<div class="errormsgbox">NIC,Email and Refrence_id already exist!</div>';
 }
  else if( $count>0 AND $count1<=0 AND $count2>0 and $count3>0) {
 ?> <script> alert('NIC,contactno and Refrence_id already exist!'); </script> <?php  $_POST['contact']=NULL; $_POST['nic']=NULL; $_POST['refid']=NULL;
 echo '<div class="errormsgbox">NIC,contactno and Refrence_id already exist!</div>';}
  else if( $count<=0 AND $count1>0 AND $count2>0 and $count3>0) {
 ?> <script> alert('Email,contact number and Refrence_id already exist!'); </script> <?php  $_POST['refid']=NULL; $_POST['contact']=NULL; $_POST['email']=NULL; 
 echo '<div class="errormsgbox">Email,contact number and Refrence_id already exist!</div>';}
 else {
 ?> <script> alert('NIC, Email , contact numberand reference id already exist!'); </script> <?php  $_POST['contact']=NULL; $_POST['email']=NULL; $_POST['refid']=NULL; $_POST['nic']=NULL;
 echo '<div class="errormsgbox">NIC, Email , contact numberand reference id already exist!<br>You may go to <a href="needhelp.php">Send ActivationLink again</a></div>';
 }
}
}

		?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="css/button.css">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Bootstrap core CSS -->
<script language="javascript">
    function Checkfiles()
    {
    var fup = document.getElementById('filename');
    var fileName = fup.value;
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
    if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" )
    {
    return true;
    } 
    else
    {
    alert("Upload Gif or Jpg images only");
    fup.focus();
    return false;
    }
    }
    </script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="navbar-fixed-top.css" rel="stylesheet">
<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="js/ie-emulation-modes-warning.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	
	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/alert.css" rel="stylesheet">
<link href="css/error.css" rel="stylesheet">
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->
<link rel="shortcut icon" href="assets/img/logocalc1.png">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<title>PIA | Signup</title>
<link rel="shortcut icon" href="assets/img/images.jpg">
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<!-- Custom Fonts -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav>
<div id="page-wrapper" class="page-wrapper-cls">
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <form action='signup.php' class="form-horizontal" role="form" method="post" enctype='multipart/form-data'>
          <h3>
            <center>
              Sign Up
            </center>
          </h3>
          <br>
          <div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="rental">Name:</label>
              <div class="col-md-3">
                <input type="text" name="fname" id = "fname" class="form-control input-md" pattern="[A-Za-z. ]{3,30}" <?php
if ( $_POST['fname'] ) {
print ' value="' . $_POST['fname'] . '"';
} ?> required/>
              </div>
            </div>   
            <div class="form-group">
              <label class="col-md-5 control-label">Father Name:</label>
              <div class="col-md-3">
                <input type="text" name="fathername" id = "fathername" class="form-control input-md" pattern="[A-Za-z. ]{3,30}" <?php
if ( $_POST['fathername'] ) {
print ' value="' . $_POST['fathername'] . '"';
} ?> required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label">Refrence id(if any):</label>
              <div class="col-md-3">
                <input type="text" name="refid" id = "refid" class="form-control input-md" pattern="[A-Za-z0-9]{11}" <?php
if ( $_POST['refid'] ) {
print ' value="' . $_POST['refid'] . '"';
} ?> />
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="room">Organization:</label>
              <div class="col-md-3">
                <select id="dept_id" name="organization" class="form-control" required <?php
if ( $_POST['organization'] ) {
print ' value="' . $_POST['organization'] . '"';
} ?>/>
                
                
                <?php 
						$query=mysqli_query($con,"SELECT * FROM `Organization` ORDER by org_name");
						while($row=mysqli_fetch_array($query))
						 { 
						 $sel= "selected";
						 	?>
                <option value="<?php echo $row['org_name'];?>" <?=$sel?> > <?php echo $row['org_name'];?> </option>
                <?php 
						} ?>
                        <option>Other</option> 
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label">Gender:</label>
              <div class="col-md-3">
                 <div class="input-group">
                 <input type="radio" id="radio1" name="gender" value="Male" 
				  <?php if(isset($_POST['gender']) == 'Male')  echo ' checked="checked"';?>  checked />
<label for="radio1">Male</label>
    <input type="radio" id="radio2" name="gender"value="Female" <?php if(isset($_POST['gender']) == 'Female')  echo ' checked="checked"';?> />
      <label for="radio2">Female</label>
	  </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label">Email:</label>
              <div class="col-md-3">
                <input type="text" name="email" id = "email" class="form-control input-md" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" title="Incorrect Email"  <?php
if ( $_POST['email'] ) {
print ' value="' . $_POST['email'] . '"';
} ?>required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label">NIC: [13Digit Number]</label>
              <div class="col-md-3">
                <input type="text" name="nic" id = "nic" class="form-control input-md" pattern="[0-9]{13}" title="Numbers Only" <?php
if ( $_POST['nic'] ) {
print ' value="' . $_POST['nic'] . '"';
} ?> required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="rental">Date of birth:</label>
              <div class="col-md-3">
               <input type="text" id="defaultEntry" name="dob" class="form-control input-md" placeholder="mm/dd/yyyy" <?php
if ( $_POST["dob"] ) {
print ' value="' . $_POST["dob"] . '"';
} ?>  required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label">Place of birth:</label>
              <div class="col-md-3">
                <input type="text" name="pob" id = "pob" class="form-control input-md"  pattern="[A-Za-z. ]{1,20}" <?php
if ( $_POST['pob'] ) {
print ' value="' . $_POST['pob'] . '"';
} ?> required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="rental">Permenant Address:</label>
              <div class="col-md-3">
                <input type="text" name="paddress" id = "address" class="form-control input-md" pattern="[A-Za-z0-9.#/\-_,' ]{6,200}"  <?php
if ( $_POST["paddress"] ) {
print ' value="' . $_POST["paddress"] . '"';
} ?>   required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="rental">Current Address:</label>
              <div class="col-md-3">
                <input type="text" name="caddress" id = "address" class="form-control input-md"  pattern="[A-Za-z0-9.#/\-_,' ]{6,200}" <?php
if ( $_POST['caddress'] ) {
print ' value="' . $_POST['caddress'] . '"';
} ?> required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="rental">Contact No.:</label>
              <div class="col-md-3">
              
             <input type="text" name="contact" id = "contact" class="form-control input-md" title="input number only"  pattern="[0-9]{11}" title="Numbers Only" <?php
if ( $_POST['contact'] ) {
print ' value="' . $_POST['contact'] . '"';
} ?> required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="rental">Profile Picture:</label>
              <div class="col-md-3">
                <li class="two">
                  <div class="left_nor">
                    <input type="file" onChange="Checkfiles()" id="logo1"  name="imageUpload" required/>
                  </div>
                </li>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="rental">NIC Attachment:</label>
              <div class="col-md-3">
                <li class="two">
                  <div class="left_nor">
                    <input type="file" onChange="Checkfiles()" id="logo1" name="nicimage" required/>
                  </div>
                </li>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="rental">Password:</label>
              <div class="col-md-3">
                <input type="password" placeholder="Password" id="password" class="form-control input-md" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" name="password" 
                title="Password should contain an upper case letter, a lower case letter, a number and a special character. Length should be atleast 8 characters" name="password" 
required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="rental">Confirm Password:</label>
              <div class="col-md-3">
                <input type="password" placeholder="Confirm Password" id="confirm_password" class="form-control input-md" required>
              </div>
            </div>
            <div class="control-group">
              <div class="controls" align="center">
                <button type="submit" id="submit" name="register" class="btn btn-success">Signup</button>
                <br>
                <br>
                <br>
                <br>
                <br>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    </nav>
  </div>
</div>
<!-- /#wrapper -->
<!-- jQuery Version 1.11.0 -->
<script>
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");
   
function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Password Doesn't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
<script src="js/jquery-1.11.0.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>
</body>

<head>
<title>jQuery Date Entry</title>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.plugin.js"></script>
<script type="text/javascript" src="js/jquery.dateentry.js"></script>
<script type="text/javascript">
$(function () {
	$('#defaultEntry').dateEntry();
});
</script>
</head>
</html>