<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Activate Your Account</title>
<style type="text/css">
body
{
	font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
}

.success
{
	border: 1px solid;
	margin: 0 auto;
	padding:10px 5px 10px 60px;
	background-repeat: no-repeat;
	background-position: 10px center;
	width:450px;
	color: #4F8A10;
	background-color: #DFF2BF;
	background-image:url('../bisma1/web/images/success.png');
}

.errormsgbox
{
	border: 1px solid;
	margin: 0 auto;
	padding:10px 5px 10px 60px;
	background-repeat: no-repeat;
	background-position: 10px center;
	width:450px;
	color: #D8000C;
	background-color: #FFBABA;
	background-image: url('../bisma1/web/images/error.png');
}
</style>
</head>
<body>
<?php
mysql_select_db('pia',mysql_connect('localhost','root',''))or die(mysql_error());
if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email']))
{
    $email = $_GET['email'];
}
if (isset($_GET['key']) && (strlen($_GET['key']) == 32))//The Activation key will always be 32 since it is MD5 Hash
{
    $key = $_GET['key'];
}
$user_query = mysql_query("SELECT active_time FROM candidate WHERE cand_email= '$email' ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													$time = $row['active_time'];
													$timestamp = strtotime('$time') + 60*60*60;
													$time = date('H:i', $timestamp);
													if($time > NOW()) {

if (isset($email) && isset($key))
{

    // Update the database to set the "activation" field to null

    $result = mysql_query("UPDATE candidate SET Activation=NULL,isactive = '1' WHERE(cand_email ='$email' AND Activation='$key')LIMIT 1") or die(mysql_error());


    // Print a customized message:
    if ($result)//if update query was successfull
    {
    echo '<div class="success">Your account is now active. You may now <a href="index.php">Log in</a></div>';

    } else
    {
        echo '<div class="errormsgbox">Oops !Your account could not be activated. Please recheck the link or contact the system administrator.</div>';

    }
}}
	else { 
?>
<script>
alert('Activation link is expired');
window.location = "index.php";
</script>
<?php } ?>

</body>
</html>
