<?php
require_once('config.php');
?>
<?php
require_once('session2.php');
?>
<?php
		if (isset($_POST['update'])){
	$vdate= mysql_real_escape_string($_POST['vdate']);
	$vamount = mysql_real_escape_string($_POST['vamount']);
	$vid = mysql_real_escape_string($_POST['vid']);
	$vimage= mysql_real_escape_string($_POST['vimage']);
	$id= mysql_real_escape_string($_POST['ref_id']);
	$adminid= mysql_real_escape_string($_SESSION['id']);
	$user_query = mysqli_query($con,"select cand_id from candidate where ref_id='$id'")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){	
													$cand = $row['cand_id'];}
													
		mysqli_query($con,"INSERT INTO `voucher` (`voucher_id`, `voucher_amount`, `Ref_id`, `voucher_attachment`,`voucher_date`, `voucher_entry_date`, `admin_id`) VALUES ('$vid', '$vamount', '$id','$vimage','$vdate', NOW(), '$adminid') ")or die(mysqli_error($con));
		
			$select = "SELECT HOST FROM information_schema.processlist where id = connection_id()";
$qry=mysqli_query($con,$select);
		while($rec = mysqli_fetch_array($qry)){
		$host = "$rec[HOST]";}
		$vs=0; $balance=0;
		$user_query = mysqli_query($con,"SELECT sum(voucher_amount) as vs FROM voucher WHERE Ref_id='$id'")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){	
													$vs = $row['vs'];}
													
				$user_query = mysqli_query($con,"SELECT max(balance) as balance FROM user_transaction WHERE cand_id='$cand'")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){	
													$balance = $row['balance'];}		
if($balance==0) { if($vs==0) { ?>
<script>
alert('Voucher is not inserted');
window.location = "finance.php";
</script>
<?php
} else { $bal= $vs; }
} else {$bal= $balance; }

$checking=mysqli_query($con,"INSERT INTO `user_transaction` (`transaction_id`, `cand_id`, `transaction_time`, `transaction_ipaddress`, `debit`, `credit`, `balance`) VALUES (NULL, '$cand', NOW(), '$host', '$vamount', '0', '$bal');")or die(mysqli_error($con));	
if($checking)
mysqli_commit($con);
else mysqli_rollback($con);
mysqli_close($con);
?>
<script>
alert('Voucher Inserted Successfully');
window.location = "finance.php";
</script>
<?php
}?>

<?php include('header.php'); ?>
            <nav>
  <div id="page-wrapper">
            <div class="container-fluid">	
  <nav>
   <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" role="form" method="post">
			<h3><center>VOUCHER ENTRY</center></h3>
			<br>
              <div class="form-group">
							  <label class="col-md-5 control-label">Voucher ID:</label>
							  <div class="col-md-3">
						 <input type="text"  class="form-control" name="vid" placeholder="Voucher ID" pattern="[0-9]{2,10}" required autofocus>
					</div>
				</div>
                <div class="form-group">
            <label class="col-md-5 control-label">Refrence id:</label>
            <div class="col-md-3">
              <input type="text" name="ref_id" id = "refid" class="form-control input-md" pattern="[A-Za-z0-9]{11}" required autofocus/>
            </div>
          </div>
			<div>
         <div class="form-group">
										 
                                         <div class="form-group">
							  <label class="col-md-5 control-label">Voucher Amount:</label>
							  <div class="col-md-3">
					 <input type="number"  class="form-control" name="vamount" placeholder="Amount" required autofocus>
				</div>
				</div>
                <div class="form-group">
							  <label class="col-md-5 control-label">Voucher Date:</label>
							  <div class="col-md-3">
						 <input type="date" name="vdate" id = "date" placeholder="dd/mm/yyyy" class="form-control input-md" max="2050-12-31" min="1947-12-31" required/>
					</div>
				</div>
           <div class="form-group">
							  <label class="col-md-5 control-label">Voucher Image:</label>
							  <div class="col-md-3">
						 <div class="left_nor"><input type="file" id="logo1" onChange="Checkfiles()" multiple accept='image/*' name="vimage" tabindex="20" value="<?php if($_POST["txtLogoFileName"]) echo $_POST["txtLogoFileName"]; else echo($LogofileName); ?>" /></div> </li>
					</div>
				</div>  
                <div class="control-group">
				<div class="controls" align="center">
						           				 <button name="update" class="btn btn-success">Confirm</button>
												 <a button id="cancel" name="cancel" class="btn btn-danger" href="finance.php" >Cancel</button></a>
						           			 </div></div>
											 <br>
											 <br>
											 <br>
											 <br>
                                   
									</tr>
									</tbody>
						            </div>
									</center>
                                 </form>      
                                    
                            </div>                          
                        </div>                     
                    </div>                   
                </div>
  </nav>
  
  </div>
  </div>
  </div>
    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
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
 <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
<script>
webshims.setOptions('forms-ext', {types: 'date'});
webshims.polyfill('forms forms-ext');
$.webshims.formcfg = {
en: {
    dFormat: '-',
    dateSigns: '-',
    patterns: {
        d: "yy-mm-dd"
    }
}
};
</script>
    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
	<?php include('script.php'); ?>
</body>
</html>
