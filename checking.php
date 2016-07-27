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

<?php if(isset($_POST['register']))
{
$isenrolled=0;
$cand_id= $_SESSION['cand_id'];
$category= mysql_real_escape_string($_POST['category']);
$module= mysql_real_escape_string($_POST['module']);
$fees= mysql_real_escape_string($_POST['fees']);
$mod = substr($module,0,9);
$station = substr($module,21);
$user_query = mysqli_query($con,"select station_id from station where station_name='$station'")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){	
													$station = $row['station_id'];}
$user_query = mysqli_query($con,"SELECT module.module_id,category.category_id FROM module,category WHERE module.category_id=category.category_id and module.module_name='$mod' and category.category_name='$category'")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){	
													$moduleid = $row['module_id'];
													$categoryid = $row['category_id'];
													}
$user_query = mysqli_query($con,"SELECT max(enroll_date) as edate FROM enrollment WHERE cand_id='$cand_id' AND module_id='$moduleid' AND category_id='$categoryid' ")or die(mysql_error());
													$row = mysqli_fetch_array($user_query);
													if(mysqli_num_rows($user_query) > 0)
													{$enrolldate = $row['edate'];
													$futureDate=date('Y-m-d', strtotime('+1 year', strtotime($enrolldate)) );
													}
												
$user_query = mysqli_query($con,"select now() as date")or die(mysql_error());
													$row = mysqli_fetch_array($user_query);
													$date = $row['date'];
 												$date = new DateTime($date);
                                               $date= $date->format('Y-m-d');
$user_query = mysqli_query($con,"SELECT isenrolled FROM `enrollment` WHERE `cand_id` = '$cand_id' AND `module_id` = '$moduleid' and isenrolled=1 ")or die(mysql_error());
													$isenrolled=mysqli_num_rows($user_query);
		$user_query = mysqli_query($con,"SELECT balance FROM user_transaction WHERE user_transaction.cand_id='$cand_id' and transaction_time=(SELECT MAX(transaction_time) from user_transaction)")or die(mysqli_error($con));
													$row = mysqli_fetch_array($user_query);
													$balance = $row['balance'];
									if($balance >= $fees)
									{$balanc=$balance- $fees;}
									else { ?> <script>
alert('You dont have sufficient amount to enroll in this course');
window.location.assign("enrollment.php");
</script><?php exit(); }

$diff = abs(strtotime($date) - strtotime($enrolldate));
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

if ($months<=3 and $isenrolled<=3)
{ ?>
<script>
alert('You are not allowed to enroll in course before 3months');
window.location.assign("enrollment.php");
</script>
<?php
exit();
} 
if ($futureDate > $date and $isenrolled>=3)
{ ?>
<script>
alert('You are not allowed to enroll in course before 1year');
window.location.assign("enrollment.php");
</script>
<?php
exit();
} 
if($isenrolled == 3)
{$mysqli_query($con,"UPDATE enrollment SET isenrolled=0 where cand_id='$cand_id' and module_id='$moduleid' ")or die(mysqli_error($con));}

$query=mysqli_query($con,"INSERT INTO `enrollment` (enroll_id,cand_id,module_id,enroll_date,station_id,category_id,isenrolled) VALUES ('', '$cand_id', '$moduleid',NOW(),'$station','$categoryid',1)")or die(mysqli_error($con));
$user_query = mysqli_query($con,"SELECT max(enroll_id) as enroll_id FROM enrollment WHERE cand_id='$cand_id' ") or die(mysqli_error($con));
	$row = mysqli_fetch_array($user_query);
													$enroll_id = $row['enroll_id'];
							
$select = "SELECT HOST FROM information_schema.processlist where id = connection_id()";
$qry=mysqli_query($con,$select);
		while($rec = mysqli_fetch_array($qry)){
		$host = "$rec[HOST]";}
$qry=mysqli_query($con,"INSERT INTO `user_transaction` (`transaction_id`, `cand_id`, `enroll_id`,`transaction_time`, `transaction_ipaddress`, `debit`, `credit`, `balance`) VALUES (NULL, '$cand_id','$enroll_id', NOW(), '$host', '0', '$fees', '$balanc')")or die(mysqli_error($con));	
 if($qry and $query)
 {
 mysqli_commit($con);
 $message = "You are successfully enrolled in category :".$category." module:".$mod;
               $candemail = $_SESSION['email'];
if (smtpmailer($candemail, 'ptc.exam@gmail.com', 'PIA| Enrollment Confirmation', 'Enrollment Confirmation', $message)) {
	// Finish the page:
                $msg='<div class="success">A confirmation email
has been sent to '.$candemail.'  </div>';

	
}
?>
 <script>
alert('You are Successfully enrolled in <?php echo $category."-".$mod; ?>');
window.location.assign("enrollment.php");
</script> <?php
}else 
{ mysqli_rollback($con); 
   $msg='<div class="errormsgbox">You could not be registered due to a system
error. We apologize for any
inconvenience.</div>';?>
<script>
alert('Error in Enrollment');
window.location.assign("enrollment.php");
</script>
<?php
}}
?>
<?php include('headcand.php'); ?>
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
      <br />
      <div class="form-group">
        <label class="col-md-5 control-label">Category:</label>
        <div class="col-md-3">
          <select id="brand" name="category" class="form-control" required="required">
            <option value="">- select -</option>
            <option value="B1">B1</option>
            <option value="B2">B2</option>
          </select>
        </div>
      </div>
     
      <div class="form-group">
        <label class="col-md-5 control-label" for="room">Station:</label>
        <div class="col-md-3">
          <select id="type" name="station" class="form-control" required="required">
          </select>
        </div>
      </div>
      
      <div class="form-group">
        <label class="col-md-5 control-label" for="room">Module:</label>
        <div class="col-md-3">
          <select id="module" name="module" class="form-control" required="required">
          </select>
        </div>
      </div>
     
     
      <div class="control-group">
        <div class="controls" align="center">
          <button type="submit" id="submit" name="register" class="btn btn-success">ADD</button>
          <a button="button" id="cancel" name="cancel" class="btn btn-danger" href="admin.php" >Cancel
          </button>
          </a> <br />
          <br />
          <br />
          <br />
          <br />
        </div>
      </div>
      </div>
    </form>
  </div>
</div>
</nav>
<!-- jQuery Version 1.11.0 -->
<script src="js/jquery-1.11.0.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<script>
$(document).ready(function(){
var selectBrand = $("#brand");
var selectType = $("#type");

var optionsList = {
    B1: [
        
								<?php 
								
						$user_query = mysqli_query($con,"SELECT station.station_name FROM station,schedule WHERE station.station_id=schedule.station_id and schedule.category_id=1 and schedule.exam_deadline > NOW() ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module=$row['station_name'];
									printf("'$module',");
						 	}?>
							
			],
    B2: [
          		
					
								<?php 
								
					$user_query = mysqli_query($con,"SELECT station.station_name FROM station,schedule WHERE station.station_id=schedule.station_id and schedule.category_id=2 and schedule.exam_deadline > NOW()")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module=$row['station_name'];
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

<script>
$(document).ready(function(){
var selectBrand = $("#brand");
var selectType = $("#type");
var selectModule = $("#module");

var optionsList = {
    KarachiB1: [
        
								<?php 
								
						$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=1 AND station.station_id=1 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
						 	}?>
							
			],
			KarachiB2: [
        
								<?php 
								
						$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=2 AND station.station_id=1 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
						 	}?>
							
			],
   PeshawarB1: [
          		
					
								<?php 
					$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=1 AND station.station_id=6 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
									}?>
    ],
	PeshawarB2: [
          		
					
								<?php 
					$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=2 AND station.station_id=6 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
									}?>
    ],
	LahoreB1: [
          		
					
								<?php 
					$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=1 AND station.station_id=2 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
									}?>
    ],
	LahoreB2: [
          		
					
								<?php 
					$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=1 AND station.station_id=2 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
									}?>
    ],
	SwatB1: [
          		
					
								<?php 
					$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=1 AND station.station_id=3 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
									}?>
    ],
SwatB2: [
          		
					
								<?php 
					$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=2 AND station.station_id=3 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
									}?>
    ],
	IslamabadB1: [
          		
					
								<?php 
					$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=1 AND station.station_id=4 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
									}?>
    ],

IslamabadB2: [
          		
					
								<?php 
					$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=2 AND station.station_id=4 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
									}?>
    ],
MultanB1: [
          		
					
								<?php 
					$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=1 AND station.station_id=5 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
									}?>
    ],
MultanB2: [
          		
					
								<?php 
					$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=2 AND station.station_id=5 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
									}?>
    ],


 QuettaB1: [
          		
					
								<?php 
					$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=1 AND station.station_id=7 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
									}?>
    ],

QuettaB2: [
          		
					
								<?php 
					$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=2 AND station.station_id=7 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
									}?>
    ],
NawabshahB1: [
          		
					
								<?php 
					$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=1 AND station.station_id=8 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
									}?>
    ],
NawabshahB2: [
          		
					
								<?php 
					$user_query = mysqli_query($con,"SELECT module.module_name,DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' ) as exam_date,station.station_name FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=2 AND station.station_id=8 and schedule.exam_deadline > NOW() and schedule.station_id=station.station_id  ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module_name = $row['module_name'];
													$module_edate = $row['exam_date'];
													$module = $module_name."-".$module_edate;
									printf("'$module',");
									}?>
    ]


 
};

selectType.change(function() {
    var type = selectType.val()+selectBrand.val();
    var options = optionsList[type];
    var html;
    
    if (options) {
        html = '<option value="">- select -</option>';
        $.each(options, function(index, value) {
            html += '<option value="' + value + '">' + value + '</option>';
        });
    } else {
        html = '<option value="">- select station -</option>';
    }
    selectModule.html(html);
}).change();
});
</script>
<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>
</body>
</html>
