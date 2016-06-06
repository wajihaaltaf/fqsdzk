<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
<title>Login</title>
<link rel="shortcut icon" href="../hr/ABS/assets/img/logocalc1.png">
<!--  Bootstrap Style -->
<link href="../hr/ABS/assets/css/bootstrap.css" rel="stylesheet" />
<!--  Font-Awesome Style -->
<link href="../hr/ABS/assets/css/font-awesome.min.css" rel="stylesheet" />
<!--  Animation Style -->
<link href="../hr/ABS/assets/css/animate.css" rel="stylesheet" />
<!--  Pretty Photo Style -->
<link href="../hr/ABS/assets/css/prettyPhoto.css" rel="stylesheet" />
<!--  Google Font Style -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<!--  Custom Style -->
<link href="../hr/ABS/assets/css/style.css" rel="stylesheet" />
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body style="background:url(../hr/ABS/assets/img/images.jpg) no-repeat center center fixed;
		-webkit-background-size: cover !important;
		-moz-background-size: cover !important;
		-o-background-size: cover !important;
		background-size: cover !important;
	">
<!--/. PRELOADER END -->
<!--./ NAV BAR END -->
<div id="home" >
<div class="overlay">
<div class="container">
<div class="span3">
<div class="title_index">
  <div class="row-fluid"> </div>
</div>
<div class="col-lg-4 col-md-5">
<div class="div-trans text-center">
<h3>Please Login</h3>
<br>
<br>
<div class="col-lg-12 col-md-12 col-sm-12" />
<form action="login.php" class="form-signin" method="post" role="form">
<div class="form-group">
  <input type="text" class="form-control input-md" name="email" id="email" placeholder="Email" required autofocus>
</div>
<div class="form-group">
  <input type="password" class="form-control input-md" name="password" id="password" placeholder="Password" required>
</div>
<a href="needhelp.php">Need Help?</a> <br>
<div class="form-group">
  <button type="submit" class="btn btn-primary btn-block" id="login" name="login">Login</button>
  <a button id="signup" name="signup" class="btn btn-primary btn-block" href="signup.php" >Signup
  </button>
  </a>
  </p>
</div>
</div>
</div>
</div>
</div>
<br>
<br>
<br>
<br>
<br>
<div class="row-fluid">
  <div class="col-md-6 col-md-offset-1"> </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="row-fluid">
  <div class="col-md-5 col-md-offset-1">
    <h4>
    <span id=tick2> </span>&nbsp;|
    <script>
				function show2(){
				if (!document.all&&!document.getElementById)
				return
				thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
				var Digital=new Date()
				var hours=Digital.getHours()
				var minutes=Digital.getMinutes()
				var seconds=Digital.getSeconds()
				var dn="PM"
				if (hours<12)
				dn="AM"
				if (hours>12)
				hours=hours-12
				if (hours==0)
				hours=12
				if (minutes<=9)
				minutes="0"+minutes
				if (seconds<=9)
				seconds="0"+seconds
				var ctime=hours+":"+minutes+":"+seconds+" "+dn
				thelement.innerHTML=ctime
				setTimeout("show2()",1000)
				}
				window.onload=show2
				//-->
</script>
    <?php
            $date = new DateTime();
            echo $date->format('l, F jS, Y');
          ?>
    <h4>
  </div>
</div>
</div>
</div>
</div>
</div>
<!--./ FOOTER SECTION END -->
<!--  Jquery Core Script -->
<script src="../hr/ABS/assets/js/jquery-1.10.2.js"></script>
<!--  Core Bootstrap Script -->
<script src="../hr/ABS/assets/js/bootstrap.js"></script>
<!--  WOW Script -->
<script src="../hr/ABS/assets/js/wow.min.js"></script>
<!--  Scrolling Script -->
<script src="../hr/ABS/assets/js/jquery.easing.min.js"></script>
<!--  PrettyPhoto Script -->
<!--  Custom Scripts -->
<script src="../hr/ABS/assets/js/custom.js"></script>
</body>
</html>