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


	if (isset($_POST['submit'])){ 
		$email=mysql_real_escape_string($_POST['cand_email']);
		$option = mysql_real_escape_string($_POST['option']);
		$activation = md5(uniqid(rand(), true));
if($email == "" || $option == "") {?>
<script>
alert('Error occured while sending email');
window.location.assign("needhelp.php");
</script>
<?php exit();}
else{
		if($option == "A") {
		$f = mysqli_query($con,"SELECT cand_id from candidate where cand_email='$email'")or die(mysqli_error($con));
													$count = mysqli_num_rows($f);
													if($count > 0)
													{
		$qry=mysqli_query($con,"UPDATE candidate set Activation='$activation',active_time=NOW() where cand_email = '$email'")or die(mysqli_error($con));
            
				$message = " To Reset Password, please click on this link:\n\n";
                $message .= WEBSITE_URL . '/PIA/reset.php?email=' . urlencode($email) . "&key=$activation";	
		

if (smtpmailer($email, 'ptc.exam@gmail.com', 'PIA| Reset Password', 'Registration Confirmation', $message)) {
	// Finish the page:
     $msg='<div class="success">! Reset Password email has been sent to '.$email.' Please click on the Link to Reset Your Password </div>';	
}

?>
<script>
alert('Message has been sent to your email address');
window.location = "index.php";
</script>
<?php }
else { ?>
<script>
alert('Email doesnot exist');
window.location = "needhelp.php";
</script>
<?php }
}
		//end of option A	
else if($option == "B" or $option == "C"){ 
$f = mysqli_query($con,"SELECT cand_id from candidate where cand_email='$email'")or die(mysqli_error($con));
													$count = mysqli_num_rows($f);
													if($count > 0){
$qry=mysqli_query($con,"UPDATE candidate set Activation='$activation',active_time=NOW() where cand_email = '$email'")or die(mysqli_error($con));

				$message = " To Activate Your Account, please click on this link:\n\n";
                $message .= WEBSITE_URL . '/PIA/activate.php?email=' . urlencode($email) . "&key=$activation";

	
if (smtpmailer($email, 'ptc.exam@gmail.com', 'PIA| Account Activation', 'Registration Confirmation', $message)) {
	// Finish the page:
                $msg='<div class="success">! Activation email
has been sent to '.$email.' Please click on the Link to Reset Your Password </div>';	
}

?>
<script>
alert('Activation Message has been sent to your email address');
window.location = "index.php";
</script>
</div>
<?php }
else { ?>
<script>
alert('Email doesnot exist');
window.location = "needhelp.php";
</script>
<?php }}
}}
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
<form class="form-horizontal" role="form" method="post">
  <h3>
    <center>
      Recover your account
    </center>
  </h3>
  <p>
    <center>
      Enter your email address
    </center>
  </p>
  <br>
  <div class="form-group">
    <label class="col-md-5 control-label">Email:</label>
    <div class="col-md-3">
      <input type="text" name="cand_email" id = "email" class="form-control input-md"  placeholder="Email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" title="Incorrect Email" required/>
    </div>
  </div>
  <input type="hidden" name="option" value="<?php echo $_POST['option']; ?>" />
  <div class="control-group">
    <div class="controls" align="center">
      <button name="submit" class="btn btn-success">Send Email</button>
      <a button id="cancel" name="cancel" class="btn btn-danger" href="index.php" >Cancel
      </button>
      </a> </div>
  </div>
  </center>
</form>
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
