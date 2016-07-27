<?php
require_once('config.php');
$msg="";
$email= $_GET['email'];
if($email == "") { ?><script>
alert("Email not sent");
		window.location = 'index.php'
		</script><?php exit(); }
else {
	$activation = md5(uniqid(rand(), true));
 $qry=mysqli_query($con,"UPDATE `candidate` SET `Activation` = '$activation' WHERE `candidate`.`cand_email` = '$email' ")or die(mysqli_error($con));
		if($qry)
		{
                DEFINE('WEBSITE_URL', 'http://localhost');
				$message = " To activate your account, please click on this link:\n\n";
                $message .= WEBSITE_URL . '/PIA/activate.php?email=' . urlencode($email) . "&key=$activation";
				
require_once 'PHPMailer/PHPMailerAutoload.php';

//define('GUSER', 'bisma@ayazahmed.com'); // GMail username
//define('GPWD', 'Bisma2015'); // GMail password



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
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		echo $error;
		?>
        <script>
alert('Message is not Sent! Check Your internet connection.');
<?php
header("location: resent.php?email=$email"); ?>
</script>
        <?php
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}

//smtpmailer('aalogic@gmail.com', 'from@mail.com', 'yourName', 'test mail message', 'Hello World!');
	
if (smtpmailer($email, 'ptc.exam@gmail.com', 'PIA| Signin', 'Registration Confirmation', $message)) {
	// Finish the page:
                $msg='<div class="success">Thank you for
registering! A confirmation email
has been sent to '.$email.' Please click on the Activation Link to Activate your account </div>';

	
}
    

            } else { // If it did not run OK.
                  $msg='<div class="errormsgbox">You could not be registered due to a system
error. We apologize for any
inconvenience.</div>';
            }

//    mysqli_close($dbc);//Close the DB Connection

 // End of the main Submit conditional.

else{?><script>
alert("Email not sent");
		window.location = 'index.php';
		</script><?php exit(); }
		}
?>