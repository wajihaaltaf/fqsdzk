<?php
require_once('config.php');
?>
<?php

session_start();
session_destroy();
$log_id = $_SESSION['log_id'];
$qry=mysqli_query($con,"UPDATE `login` SET `logout_time` = now() WHERE `login`.`login_id` = '$log_id'")or die(mysqli_error($con));
if($qry)
mysqli_commit($con);
else mysqli_rollback($con);
mysqli_close($con);
header('location:index.php');
?>