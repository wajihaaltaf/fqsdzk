<?php
require_once('config.php');
if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email']))
{
    $email = $_GET['email'];
}
if (isset($_GET['key']) && (strlen($_GET['key']) == 32))//The Activation key will always be 32 since it is MD5 Hash
{
    $key = $_GET['key'];
}

$user_query = mysqli_query($con,"SELECT active_time FROM candidate WHERE cand_email= '$email' ")or die(mysqli_error($con));
													$row = mysqli_fetch_array($user_query);
													$time = $row['active_time'];
													$timestamp = strtotime('$time') + 60*60*60;
													$time = date('H:i', $timestamp);
													if($time > date("h:i:sa")) {
if (isset($_POST['update']))
{ 
$npassword= md5(mysql_real_escape_string($_POST['pwd1']));
if ($npassword=="" || $email == "")
{ ?>
<script>
alert('Email not sent');
window.location = "index.php";
</script>
<?php exit(); }
else {
$user_query = mysqli_query($con,"SELECT `Activation` FROM candidate WHERE candidate.cand_email= '$email' ")or die(mysqli_error($con));
													$row = mysqli_fetch_array($user_query);
													$activation = $row['Activation'];
													if($activation == $key) {
  $result = mysqli_query($con,"UPDATE candidate SET Activation=NULL,cand_password = '$npassword' WHERE cand_email ='$email'") or die(mysqli_error($con));

    // Print a customized message:
    if ($result)//if update query was successfull
    {
    echo '<div class="success">Your account password is changed. You may now <a href="index.php">Log in</a></div>';

    } else
    {
        echo '<div class="errormsgbox">Oops !Your account could not be activated. Please recheck the link or contact the system administrator.</div>';

    }
	}else {?>
<script>
alert('Activation link is expired');
window.location = "index.php";
</script>
<?php } 
	}}}
	else { 
?>
<script>
alert('Activation link is expired');
window.location = "index.php";
</script>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
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
<title>Edit User</title>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
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
<body bgcolor="#FFFFFF">
<form class="form-horizontal" role="form" method="post" autocomplete="off">
  <h3>
    <center>
      Recover your account
    </center>
  </h3>
  <br>
  <div class="form-group">
    <label class="col-md-5 control-label" for="rental">New:</label>
    <div class="col-md-3">
      <input type="password" placeholder="Password" id="password" class="form-control input-md" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" name="pwd1" 
                title="Password should contain an upper case letter, a lower case letter, a number and a special character. Length should be atleast 8 characters" name="password" 
required />
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-5 control-label" for="rental">Re-type New:</label>
    <div class="col-md-3">
      <input type="password" placeholder="Confirm Password" id="confirm_password" class="form-control input-md" name="pwd2" required>
    </div>
  </div>
  <div class="control-group">
    <div class="controls" align="center">
      <button name="update" class="btn btn-success">Save Changes</button>
      <a button id="cancel" name="cancel" class="btn btn-danger" href="index.php" >Cancel
      </button>
      </a> </div>
  </div>
  </center>
</form>
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
</html>
