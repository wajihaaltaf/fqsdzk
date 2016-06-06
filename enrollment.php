<?php
mysql_select_db('pia',mysql_connect('localhost','root',''))or die(mysql_error());
$con = mysqli_connect("localhost", "root", "", "pia");
require_once('session1.php');
?>
<?php if(isset($_POST['register']))
{
$cand_id= $_SESSION['cand_id'];
$station = $_POST['station'];
$category= mysql_real_escape_string($_POST['category']);
$module= mysql_real_escape_string($_POST['module']);
$fees= mysql_real_escape_string($_POST['fees']);
$mod = substr($module,0,9);
$user_query = mysql_query("SELECT module.module_id,category.category_id FROM module,category WHERE module.category_id=category.category_id and module.module_name='$mod' and category.category_name='$category' ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){	
													$moduleid = $row['module_id'];
													$categoryid = $row['category_id'];
													}
$user_query = mysql_query("SELECT * FROM enrollment WHERE cand_id='$cand_id' AND module_id='$moduleid' AND category_id='$categoryid'" ) or die(mysql_error());
if(mysql_num_rows($user_query) > 0) {
		while($rec = mysql_fetch_array($user_query)){
		$edate ="$rec[enroll_date]";
		$date=date("Y/m/d"); }
		$diff = abs(strtotime($date) - strtotime($edate));
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
if ($years >=0 && $months>=3 && $days>=0 && $mid==$moduleid && $cid==$cand_id)
{ ?>
<script>
alert('You are not allowed to enroll in course before 3months');
window.location.assign("enrollment.php");
</script>
<?php
	}
	else { ?>
<script>
alert('You are already enrolled');
window.location.assign("enrollment.php");
</script>
<?php }} else {
	$user_query = mysql_query("SELECT max(enroll_id) as enroll_id FROM enrollment WHERE cand_id=1 ") or die(mysql_error());
	$row = mysql_fetch_array($user_query);
													$enroll_id = $row['enroll_id'];
									
mysql_query("INSERT INTO `enrollment` (`enroll_id`, `cand_id`, `module_id`,`enroll_date`,station_id,category_id) VALUES ('', '$cand_id', '$moduleid',NOW(),'$station','$categoryid')")or die(mysql_error());
$user_query = mysql_query("SELECT balance FROM user_transaction WHERE user_transaction.cand_id='$cand_id' and transaction_time=(SELECT MAX(transaction_time) from user_transaction)")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													$balance = $row['balance'];
									}
									if($balance > $fees)
									{$balanc=$balance- $fees;}
									else { ?> <script>
alert('You dont have sufficient amount to enroll in this course');
window.location.assign("enrollment.php");
</script><?php }
$select = "SELECT HOST FROM information_schema.processlist where id = connection_id()";
$qry=mysql_query($select);
		while($rec = mysql_fetch_array($qry)){
		$host = "$rec[HOST]";}
$qry=mysql_query("INSERT INTO `user_transaction` (`transaction_id`, `cand_id`, `transaction_time`, `transaction_ipaddress`, `debit`, `credit`, `balance`) VALUES (NULL, '$cand_id', NOW(), '$host', '0', '$fees', '$balanc')")or die(mysql_error());	
}
 if($qry) {
?>
 <script>
alert('You are Successfully enrolled in <?php echo $category."-".$mod; ?>');
window.location.assign("enrollment.php");
</script> <?php
}else 
{ ?>
<script>
alert('Error in Enrollment');
window.location.assign("enrollment.php");
</script>
<?php
}
}
 ?>
<?php include('headercand.php'); ?>

<nav>
<div id="page-wrapper" class="page-wrapper-cls">
<div id="page-inner">
  <div class="row">
    <div class="col-md-12">
    <form class="form-horizontal" role="form" method="post">
      <h3>
        <center>
          Module Enrollment
        </center>
      </h3>
      <br>
      <div class="form-group">
        <label class="col-md-5 control-label">Category:</label>
        <div class="col-md-3">
          <select id="brand" name="category" class="form-control" required>
            <option value="">- select -</option>
            <option value="B1">B1</option>
            <option value="B2">B2</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-5 control-label" for="room">Module:</label>
        <div class="col-md-3">
          <select id="type" name="module" class="form-control" required>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-5 control-label" for="room">Station:</label>
        <div class="col-md-3">
          <select id="dept_id" name="station" class="form-control" required/>
          
          <option></option>
          <?php 
						$query=mysql_query("SELECT * FROM station ORDER by station_name");
						while($row=mysql_fetch_array($query))
						 { 
						 $sel= "selected";
						 	?>
          <option value="<?php echo $row['station_id'];?>" <?=$sel?> > <?php echo $row['station_name'];?> </option>
          <?php 
						} ?>
          </select>
        </div>
      </div>
      <?php $cand_id= $_SESSION['cand_id'];
	  $user_query = mysql_query("select * from candidate where cand_id='$cand_id'")or die(mysql_error());
													$row = mysql_fetch_array($user_query);
											        $candorg= $row['cand_organization'];
	  if ($candorg=="PIA") 
			 $fees=500;
			 else 
			 $fees=2000; ?>
               <div class="form-group">
        <label class="col-md-5 control-label" for="room">Fees:</label>
        <div class="col-md-3">
             <input type="text" name="fees" value="<?php echo $fees; ?>" class="form-control" readonly/>
             </div></div>
      <div class="control-group">
        <div class="controls" align="center">
          <button type="submit" id="submit" name="register" class="btn btn-success">ADD</button>
          <a button id="cancel" name="cancel" class="btn btn-danger" href="admin.php" >Cancel
          </button>
          </a> <br>
          <br>
          <br>
          <br>
          <br>
        </div>
      </div>
      </div>
    </form>
  </div>
</div>
</nav>
<!-- jQuery Version 1.11.0 -->
<script src="../hr/ABS/js/jquery-1.11.0.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../hr/ABS/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
var selectBrand = $("#brand");
var selectType = $("#type");

var optionsList = {
    B1: [
        
								<?php 
								
						$user_query = mysql_query("SELECT module.module_name,DATE_FORMAT( schedule.exam_date,  '%d-%m-%Y' ) as exam_date FROM module,schedule WHERE schedule.module_id=module.module_id AND module.category_id=1")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
												$module = $module_name."-".$module_edate;
									printf("'$module',");
						 	}?>
							
			],
    B2: [
          		
					
								<?php 
								
						$user_query = mysql_query("SELECT module.module_name,DATE_FORMAT( schedule.exam_date,  '%d-%m-%Y' ) as exam_date FROM module,schedule WHERE schedule.module_id=module.module_id AND module.category_id=2")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													
													$module = $module_name."-".$module_edate;
									printf("'$module',");
						 	}?>
    ]
};

selectBrand.change(function() {
    var brand = selectBrand.val();
    var options = optionsList[brand];
    var html;
    
    if (options) {
        html = '<option value="">- select -</option>';
        $.each(options, function(index, value) {
            html += '<option value="' + value + '">' + value + '</option>';
        });
    } else {
        html = '<option value="">- select category -</option>';
    }
    selectType.html(html);
}).change();
});
</script>
<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>
</body>
</html>
