<?php
mysql_select_db('pia',mysql_connect('localhost','root',''))or die(mysql_error());
?>

<?php
require_once('session1.php');
?>

<?php
$moduleid= $_GET['id'];
$cand_id = $_SESSION['cand_id'];
$user_query = mysql_query("select * from module where module_id=$moduleid")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													$modulename = $row['module_name'];
													$coursetitle = $row['course_title'];
													}
$user_query = mysql_query("select * from candidate where cand_id=$cand_id")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													$candname = $row['cand_full_name'];
													$candlname = $row['cand_last_name'];
													$cname= $candname.$candlname;
													$candfname = $row['cand_father_name'];
													$candrefid = $row['Ref_id'];
													$candnic = $row['cand_nic'];
													$canddob = $row['cand_dob'];
													$candgender = $row['cand_gender'];
													$candemail = $row['cand_email'];
													$candorg= $row['cand_organization'];
													}
$user_query = mysql_query("select * from voucher where cand_id=$cand_id and voucher_status=1")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){	
													$voucherid = $row['voucher_id'];
													$vamount = $row['voucher_amount'];
											}
											$vramount=0;
$user_query = mysql_query("select * from voucher_history where voucher_id=$voucherid")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){	
													$vramount= $row['voucher_rem_amount'];
			
											}									
			if (isset($_POST['submit']))
			{
			$v = $_POST['v'];
			$fees= $_POST['fees'];
			$amount = $v - $fees;
			mysql_query("INSERT INTO `enrollment` (`enroll_id`, `cand_id`, `module_id`,`enroll_date`) VALUES ('', '$cand_id', '$moduleid',NOW())")or die(mysql_error());
			mysql_query("INSERT INTO `voucher_history` (`voucher_hist_id`, `voucher_id`, `voucher_rem_amount`, `module_id`, `voucher_date`, `voucher_deducted_amt`) VALUES ('', '$voucherid', '$amount', '$moduleid', NOW(), '$fees')")or die(mysql_error());								
?>
<script>
alert('Enrolled Successfully. \nRemaining voucher amount: <?php echo $amount; ?> ');
window.location = "enroll.php";
</script>
<?php
}?>
<!DOCTYPE html>
<html lang="en">

<head>
<style>
tr {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-weight: bold;
}
</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<!-- Bootstrap core CSS -->
    <link href="../hr/ABS/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../hr/ABS/navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../hr/ABS/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	
	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/alert.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

 

	
	<script type="text/javascript" src="../hr/ABS/js/jquery.min.js"></script>
	<script type="text/javascript" src="../hr/ABS/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../hr/ABS/js/scripts.js"></script>
    <title>Home</title>
<link rel="shortcut icon" href="../hr/ABS/assets/img/logocalc1.png">
    <!-- Bootstrap Core CSS -->
    <link href="../hr/ABS/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../hr/ABS/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../hr/ABS/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../hr/ABS/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->	 <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
  <body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <div class="span3">&nbsp;&nbsp;&nbsp;&nbsp;<img class="index_logo" height="45" width="100" src="../hr/ABS/assets/img/logocalc1.png"></div>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>&nbsp;<?php
				//Check to see if the user is logged in.
				
				if(isset($_SESSION['fname']))
				{ 
				echo 
				"".$_SESSION['fname']." ";
				}

				?>
             <b class="caret"></b></a>
                    <ul class="dropdown-menu">
					<li>
                        <a href="../hr/ABS/ceo_edit.php"><i class="fa fa-users fa-lg"></i>&nbsp; Update Info</a>
                    </li>
					<li class="divider"></li>
                    <li>
                        <a href="../hr/ABS/session_logout.php"><i class="fa fa-fw fa-power-off"></i>&nbsp;Log Out</a>
                    </li>
                    </ul>
                </li>
            </ul>
        <?php $image = $_SESSION['image']; ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                <li>
                        <div class="user-img-div">
                       <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" width ="200px" height="100px" class="img-circle"/>
                        </div>
                    </li>
                    <li class="active">
                        <a href="../hr/ABS/ceopage.php"><i class="fa fa-fw fa-home"></i>Home</a>
                    </li>
                  <li>
                        <a href="../hr/ABS/aboutusceo.php"><i class="glyphicon glyphicon-info-sign"></i> About Us</a>
                    </li>
                </ul>
            </div>
        </nav>
            <!-- Page Heading -->
<div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
			<nav>
            <form method="post" name="form" />
			<table style="width:50%">
     
            <tr><td>Name:</td> <td><?php echo $cname; ?></td></tr>
             <tr><td>Father Name:</td> <td><?php echo $candfname; ?></td></tr>
             <tr><td>Refrence id:</td> <td><?php echo $candrefid; ?></td></tr>
             <tr><td>NIC:</td> <td><?php echo $candname; ?></td></tr>
             <tr><td>Date of Birth:</td> <td><?php echo $canddob; ?></td></tr>
             <tr><td>Gender:</td> <td><?php echo $candgender; ?></td></tr>
             <tr><td>Email id:</td> <td><?php echo $candemail; ?></td></tr>
             <tr><td>Organization:</td> <td><?php echo $candorg; ?></td></tr>
             <tr><td>Course Name:</td> <td><?php echo $coursetitle; ?></td></tr>
             <tr><td>Module name:</td> <td><?php echo $modulename; ?></td></tr>
             <?php if ($candorg=="PIA") 
			 $fees=500;
			 else 
			 $fees=2000; ?>
             <input type="hidden" name="fees" value="<?php echo $fees; ?>" />
             <tr><td>Module Fee:</td> <td><?php echo $fees; ?></td></tr>
                  <?php  $select ="select module_id, cand_id,enroll_date from enrollment";
$qry=mysql_query($select);
		while($rec = mysql_fetch_array($qry)){
		$mid = "$rec[module_id]";
		$cid ="$rec[cand_id]";
		$edate ="$rec[enroll_date]";
		$date=date("Y/m/d");
		$diff = abs(strtotime($date) - strtotime($edate));
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
if ($years >=0 && $months>=3 && $days>=0 && $mid==$moduleid && $cid==$cand_id)
{ ?>  <script>
alert('You are not allowed to enroll in course before 3months');
window.location.assign("enroll.php");
</script>
	<?php
	}	if($mid==$moduleid && $cid==$cand_id) {
		 ?>
         <script>
alert('You are already enrolled in this course');
window.location.assign("enroll.php");
</script>
<?php 
}	}	?>
        <?php if($vramount == "0"): { $v = $vamount;
		?>
        <tr><td>Current voucher amount:</td> <td><?php echo $vamount;} ?></td></tr>
        <?php elseif($vramount>$fees): {  $v = $vramount; 
		?>
        <tr><td>Current voucher amount:</td> <td><?php echo $vramount; }?></td></tr>
        	 <?php 
			 elseif($vramount< $fees): {  $v = $vramount;
			 ?>
		<tr><td>Current voucher amount:</td> <td><?php echo $vramount; ?></td></tr>
        	<script>
alert('Not Enough amount in voucher');
window.location.assign("enroll.php");
</script>
<?php 
}		
endif; ?>
<input type="hidden" name="v" value="<?php echo $v; ?>" />
            </table>
             <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block" id="login" name="submit">Enroll</button>
                       </div>
           </form>
	</nav>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="../hr/ABS/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../hr/ABS/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../hr/ABS/js/plugins/morris/raphael.min.js"></script>
    <script src="../hr/ABS/js/plugins/morris/morris.min.js"></script>
    <script src="../hr/ABS/js/plugins/morris/morris-data.js"></script>
	</body>
</html>