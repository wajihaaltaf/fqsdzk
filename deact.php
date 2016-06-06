<?php
mysql_select_db('pia',mysql_connect('localhost','root',''))or die(mysql_error());
?>
<?php
require_once('session2.php');
?>
<?php
$cand_id=$_GET['id'];
$email = $_GET['email'];
mysql_query("UPDATE candidate SET isactive ='0',disabled_by = '$email',disabled_at= NOW() WHERE cand_id = '$cand_id'")or die(mysql_error()); 	
?>
<script>
alert('Account Deactivated Successfully');
window.location = "deactivate.php";
</script>