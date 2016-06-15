<?php
require_once('config.php');
?>
<?php if (!isset($_POST['register'])){ $_POST['fname']= NULL; $_POST['fathername']= NULL; $_POST['dob']=NULL; $_POST['pob']=NULL; $_POST['organization']= NULL; $_POST['paddress']=NULL; $_POST['caddress']=NULL; 
$_POST['contact']=NULL; $_POST['image']=NULL; $_POST['nicimage']=NULL; $_POST['nic']=NULL;} ?>
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
    $img = mysql_real_escape_string($_POST['image']);
	$nicimg = mysql_real_escape_string($_POST['nicimage']);
	
	$f = mysqli_query($con,"SELECT cand_id from candidate where cand_email='$email' or cand_nic='$NIC' or cand_contactno='$contact' or Ref_id='$refid' ")or die(mysqli_error($con));
													$count = mysqli_num_rows($f);
													if($count <= 0)
													{
	$checking=mysqli_query($con,"INSERT INTO `candidate` (`Ref_id`, `cand_id`, `cand_password`, `cand_full_name`, `cand_father_name`, `cand_nic`, `cand_dob`, `cand_gender`, `cand_contactno`, `cand_email`, `cand_permenant_address`, `cand_current_address`, `cand_nic_attachment`, `cand_profile_pic`,`cand_pob`,`cand_organization`,`isactive`) VALUES ('0', '', '$password', '$firstname', '$fathername', '$NIC', '$bdate', '$gender', '$contact', '$email', '$paddress', '$caddress','$nicimg','$img','$pob','$organization','0')")or die(mysqli_error($con));
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
<?php }}
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
 ?> <script> alert('NIC already exist!'); </script> <?php }
 else if($count<=0 AND $count1>0 AND $count2<=0 and $count3<=0) {
 ?> <script> alert('email already exist!'); </script> <?php }
 else if ($count<=0 AND $count1<=0 AND $count2>0 and $count3<=0)
 {?> <script> alert('contact no already exist!'); </script> <?php
 }
  else if ($count<=0 AND $count1<=0 AND $count2<=0 and $count3>0)
 {?> <script> alert('Refrence id already exist!'); </script> <?php
 }
 else if( $count>0 AND $count1>0 AND $count2<=0 and $count3<=0) {
 ?> <script> alert('NIC and email already exist!'); </script> <?php }
 else if( $count>0 AND $count1<=0 AND $count2>0 and $count3<=0) {
 ?> <script> alert('NIC and contact number already exist!'); </script> <?php }
 else if( $count<=0 AND $count1>0 AND $count2>0 and $count3<=0) {
 ?> <script> alert('Email and contact number already exist!'); </script> <?php }
 else if( $count<=0 AND $count1<=0 AND $count2>0 and $count3>0) {
 ?> <script> alert('Refrence_id and contact number already exist!'); </script> <?php }
 else if( $count<=0 AND $count1>0 AND $count2<=0 and $count3>0) {
 ?> <script> alert('Refrence_id and Email already exist!'); </script> <?php }
 else if( $count>0 AND $count1<=0 AND $count2<=0 and $count3>0) {
 ?> <script> alert('Refrence_id and NIC already exist!'); </script> <?php }
 else if( $count>0 AND $count1>0 AND $count2>0 and $count3<=0) {
 ?> <script> alert('NIC,Email and Contact already exist!'); </script> <?php }
 else if( $count>0 AND $count1>0 AND $count2<=0 and $count3>0) {
 ?> <script> alert('NIC,Email and Refrence_id already exist!'); </script> <?php }
  else if( $count>0 AND $count1<=0 AND $count2>0 and $count3>0) {
 ?> <script> alert('NIC,contactno and Refrence_id already exist!'); </script> <?php }
  else if( $count<=0 AND $count1>0 AND $count2>0 and $count3>0) {
 ?> <script> alert('Email,contact number and Refrence_id already exist!'); </script> <?php }
 else {
 ?> <script> alert('NIC, Email and contact number already exist!'); </script> <?php
 }
}
}

		?>
<!DOCTYPE html>
<html lang="en">
<head>
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
        <form class="form-horizontal" role="form" method="post">
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
                <input type="text" name="fname" id = "fname" class="form-control input-md" pattern="[A-Za-z. ]{6,30}" <?php
if ( $_POST['fname'] ) {
print ' value="' . $_POST['fname'] . '"';
} ?> required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label">Father Name:</label>
              <div class="col-md-3">
                <input type="text" name="fathername" id = "fathername" class="form-control input-md" pattern="[A-Za-z. ]{6,30}" <?php
if ( $_POST['fathername'] ) {
print ' value="' . $_POST['fathername'] . '"';
} ?> required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label">Refrence id(if any):</label>
              <div class="col-md-3">
                <input type="text" name="refid" id = "refid" class="form-control input-md" pattern="[A-Za-z0-9]{11}" />
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
                  <div id="radioBtn" class="btn-group" required> <a class="btn btn-primary btn-sm Active" data-toggle="gender"
			data-title="Male">Male</a> <a class="btn btn-primary btn-sm notActive" data-toggle="gender" data-title="Female">Female</a> </div>
                  <input type="hidden" name="gender" id="gender" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label">Email:</label>
              <div class="col-md-3">
                <input type="text" name="email" id = "email" class="form-control input-md" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" title="Incorrect Email"required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label">NIC: [14Digit Number]</label>
              <div class="col-md-3">
                <input type="text" name="nic" id = "nic" class="form-control input-md" pattern="[0-9]{14}" title="Numbers Only" <?php
if ( $_POST['nic'] ) {
print ' value="' . $_POST['nic'] . '"';
} ?> required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="rental">Date of birth:</label>
              <div class="col-md-3">
                <input type="date" id="birthday" name="dob" size="20" max="2050-12-31" min="1950-12-31" class="form-control input-md" placeholder="dd/mm/yyyy" <?php
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
              
             <input type="text" name="contact" id = "contact" class="form-control input-md" title="input number only"  pattern="[0-9]{11}" title="Numbers Only" required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="rental">Profile Picture:</label>
              <div class="col-md-3">
                <li class="two">
                  <div class="left_nor">
                    <input type="file" id="logo1" onChange="Checkfiles()" multiple accept='image/*' name="image" tabindex="20" value="<?php if($_POST["txtLogoFileName"]) echo $_POST["txtLogoFileName"]; else echo($LogofileName); ?>" <?php
if ( $_POST['image'] ) {
print ' value="' . $_POST['image'] . '"';
} ?> required/>
                  </div>
                </li>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="rental">NIC Attachment:</label>
              <div class="col-md-3">
                <li class="two">
                  <div class="left_nor">
                    <input type="file" id="logo1" onChange="Checkfiles()" multiple accept='image/*' name="nicimage" tabindex="20" value="<?php if($_POST["txtLogoFileName"]) echo $_POST["txtLogoFileName"]; else echo($LogofileName); ?>" required/>
                  </div>
                </li>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="rental">Password:</label>
              <div class="col-md-3">
                <input type="password" placeholder="Password" id="password" class="form-control input-md" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" name="password" <?php
if ( $_POST['nicimage'] ) {
print ' value="' . $_POST['nicimage'] . '"';
} ?> 
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
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
<script type="text/javascript">
    var datefield=document.createElement("input")
    datefield.setAttribute("type", "date")
    if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
        document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
        document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n')
        document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n') 
    }
</script>
<script>
if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
    jQuery(function($){ //on document.ready
        $('#birthday').datepicker();
    })
}
</script>
<script src="js/jquery-1.11.0.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>
</body>
</html>
