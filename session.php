<?php
mysql_select_db('billdb', mysql_connect('localhost', 'root', ''))or die(mysqli_error($con));
?>

<?php
 session_start(); 
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['admin_id']) || (trim($_SESSION['admin_id']) == '')) { ?>

<?php
}
$session_id=$_SESSION['id'];
$user_query = mysqli_query($con,"select * from admin where admin_id = '$session_id'")or die(mysqli_error($con));
$user_row = mysqli_fetch_array($user_query);
$user_username = $user_row['username'];
?>