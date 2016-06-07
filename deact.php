<?php
require_once('config.php');
?>
<?php
require_once('session2.php');
?>
<?php
$cand_id=$_GET['id'];
$email = $_GET['email'];
mysqli_query($con,"UPDATE candidate SET isactive ='0',disabled_by = '$email',disabled_at= NOW() WHERE cand_id = '$cand_id'")or die(mysqli_error($con)); 	
?>
<script>
alert('Account Deactivated Successfully');
window.location = "deactivate.php";
</script>