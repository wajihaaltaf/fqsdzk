<?php
mysql_select_db('pia',mysql_connect('localhost','root',''))or die(mysql_error());
?>

<?php
require_once('session1.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
      
    function drawChart() {
      var jsonData = $.ajax({
          url: "getData.php",
          dataType:"json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, {width: 600, height: 400});
    }

    </script>
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
<title>Home</title>
	<link rel="shortcut icon" href="assets/img/logocalc1.png">

	
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
  
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
				
				if(isset($_SESSION['username']))
				{ 
				echo 
				"".$_SESSION['username']." ";
				}

				?>
                <b class="caret"></b></a>
                    <ul class="dropdown-menu">
					<li>
                        <a href="admin_edit.php"><i class="fa fa-users fa-lg"></i>&nbsp; Update Info</a>
                    </li>
					<li class="divider"></li>
                    <li>
                        <a href="session_logout.php"><i class="fa fa-fw fa-power-off"></i>&nbsp;Log Out</a>
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
                        <a href="adminpage.php"><i class="fa fa-fw fa-home"></i>Home</a>
                    </li>
                 
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-users fa-lg"></i>Recruitment <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                        <li>
                                <a href="tenant_room.php" class="glyphicon glyphicon-eye-open">&nbsp;Test</a>
                            </li>
							<li>
                                <a href="register.php" class="glyphicon glyphicon-plus">&nbsp;Interview</a>
                            </li>
                        
                            <li>
                                <a href="finaladd.php" class="glyphicon glyphicon-plus">&nbsp;Manager's Approved</a>
                            </li>
                            <li>
                                <a href="finally.php" class="glyphicon glyphicon-plus">&nbsp;CEO Approved</a>
                            </li>
                        </ul>
                    </li>
                    </li>
					<li>
                        <a href="water.php"><i class="glyphicon glyphicon-tint"></i>&nbsp; Request</a>
                    </li>
                    <li>
                        <a href="reqinsert.php"><i class="glyphicon glyphicon-tint"></i>&nbsp; Add Request</a>
                    </li>
                    <li>
                                <a href="giveloan.php" class="glyphicon glyphicon-plus">&nbsp;Loan</a>
                            </li>
					<li>
                        <a href="tenant_log.php"><i class="glyphicon glyphicon-sort"></i>Employee Logs</a>
                    </li>
                    <li>
                        <a href="about_us.php"><i class="glyphicon glyphicon-info-sign"></i> About Us</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
  <div id="page-wrapper">
            <div class="container-fluid">	
  <nav>
   <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">DASHBOARD</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info">
       
                        </div>
                    </div>
                </div>
                           <div class="row">
            <div class=" col-md-4 col-sm-4">
                <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Project #</th>
                                        <th>Project name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
			$query=mysql_query("select * FROM project")or die(mysql_error());
						while($row=mysql_fetch_array($query)){
			?>
                                     <tr>
                                        <td><?php echo $row['proj_id']; ?></td>
                                        <td><?php echo $row['proj_title']; } ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                <div class="alert  alert-info">
                    <div class="current-notices">

                            <h3>Current Notices :</h3>
                    <hr />
                    <ul>
                        <?php 
						$query=mysql_query("select * FROM post where post_status = '1'")or die(mysql_error());
		while($row=mysql_fetch_array($query)) {
						?>
                        <li>
                        <?php echo $row['post_detail']; }?> 
                        </li>
                    </ul>
                        </div>
                        </div>
  
                        </div>
              
             
              <div class=" col-md-8 col-sm-8">
                  <div class="list-group">
                            <a href="#" class="list-group-item active">
                                <h4 class="list-group-item-heading">You are logged in as: </h4>
                                <p class="list-group-item-text" style="line-height: 30px;">
                               Name: <?php echo $_SESSION['username']; ?>
                               <br>
                              Position: <?php echo $_SESSION['position']; ?>
                                </p>
                            </a>
                        </div>
                  <br />
                  <div class=" col-md-8 col-sm-8">
              <div id="chart_div"></div>
        </div>
                               </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
        </div>
    <!-- /. WRAPPER  -->

  </nav>
  
  </div>
  </div>
  </div>
    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
	<?php include('script.php'); ?>
</body>
</html>