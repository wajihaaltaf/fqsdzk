<?php
mysql_select_db('pia',mysql_connect('localhost','root',''));
?>
<?php

session_start();
session_destroy();
$log_id = $_SESSION['log_id'];
mysql_query("UPDATE `login` SET `logout_time` = now() WHERE `login`.`login_id` = '$log_id'")or die(mysql_error());
header('location:index.php');
?>