<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

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

 

	
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
    <title>Home</title>
<link rel="shortcut icon" href="assets/img/logocalc1.png">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->	 <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Gender', 'fd'],
<?php 
$select="SELECT COUNT(*) as COUNTING,cand_gender FROM candidate GROUP by candidate.cand_gender ";
		$qry=mysqli_query($con,$select);
		while($rec = mysqli_fetch_array($qry)){
		$uname = "$rec[COUNTING]";
		$gender = "$rec[cand_gender]";
		?>
          ['<?php echo $gender; ?>',    <?php echo $uname; ?>],
<?php } ?>
        ]);
        var options = {
          title: 'Male to Female Candidate'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));

        chart.draw(data, options);
	  var data = google.visualization.arrayToDataTable([
          ['Position', 'fd'],
<?php 
$select = "SELECT DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(cand_dob, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(cand_dob, '00-%m-%d')) AS age FROM candidate group by age";
			
	$qry=mysqli_query($con,$select);
		while($rec = mysqli_fetch_array($qry)){
		$uname = "$rec[age]";
		?>
          ['<?php echo $uname; ?>',    <?php echo $uname; ?>],
<?php } ?>
        ]);
        var options = {
          title: 'Candidate by Age'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart3'));

        chart.draw(data, options);
		var data = google.visualization.arrayToDataTable([
          ['Department', 'fd'],
<?php 
$select = "SELECT count(candidate.cand_id) as COUNTING, candidate.cand_organization FROM candidate group by candidate.cand_organization  ";
			//$result = mysql_fetch_array(mysql_query($select));
	$qry=mysqli_query($con,$select);
		while($rec = mysqli_fetch_array($qry)){
		$uname = "$rec[COUNTING]";
		$gender = "$rec[cand_organization]";
		?>
          ['<?php echo $gender; ?>',    <?php echo $uname; ?>],
<?php } ?>
        ]);
        var options = {
          title: 'Candidate by Organization'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options); }
    </script>


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
               <div class="span3">&nbsp;&nbsp;&nbsp;&nbsp;<img class="index_logo" height="45" width="100" src="assets/img/logocalc1.png"></div>
            </div>


            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>&nbsp;<?php
				//Check to see if the user is logged in.
				
				if(isset($_SESSION['email']))
				{ 
				echo 
				"".$_SESSION['email']." ";
				}

				?>
             <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                    <li>
                        <a href="session_logout.php"><i class="fa fa-fw fa-power-off"></i>&nbsp;Log Out</a>
                    </li>
                    </ul>
                </li>
            </ul>
        
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
             
                    <li class="active">
                        <a href="admin.php"><i class="fa fa-fw fa-home"></i>Home</a>
                    </li>
                  <li>
                        <a href="approverequest.php"><i class="glyphicon glyphicon-info-sign"></i>Approve Request</a>
                    </li>
                     <li>
                        <a href="schedule.php"><i class="glyphicon glyphicon-info-sign"></i>Add Schedule</a>
                    </li>
                    <li>
                        <a href="updateprofile.php"><i class="glyphicon glyphicon-info-sign"></i>Update</a>
                    </li>
                     <li>
                        <a href="candidatelog.php"><i class="glyphicon glyphicon-info-sign"></i>Candidate Log</a>
                    </li>
                    <li>
                        <a href="createrecord.php"><i class="glyphicon glyphicon-info-sign"></i>Record</a>
                    </li>
                    <li>
                        <a href="deactivate.php"><i class="glyphicon glyphicon-info-sign"></i>Deactivate</a>
                    </li>
                    
                </ul>
            </div>
        </nav>
            <!-- Page Heading -->
<div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
			